/**
 *
 * @param url
 * @param type
 * @param data
 * @constructor
 */
function DatatableInit(
    {
        url = '',
        method = 'GET',
        data = new FormData,
        selector,
        columns = [],
        prev,
        next
    }){
    this.url = url;
    this.method = method;
    this.data = data;
    this.selector = selector;
    this.prev = prev;
    this.next = next;
    this.columns = columns;
    this.data.append('_token', document.querySelector('input[name="_token"]').value);
}

DatatableInit.prototype.run = async function(selector = this.selector, columns = this.columns, prev = this.prev, next = this.next){

    await fetch(this.url, {
        method: this.method,
        body: this.data,
        headers: {
            'Accept': 'application/json',
        },
    }).then(function(result) {
        if(result.ok){
            return result.json().then(function(data) {
                let page = data.current_page;
                let perPage = data.per_page;
                let totalCount = data.total_count;
                let total_pages = data.number_of_pages;
                let found_count = data.found_count;

                document.querySelector(prev).setAttribute('data-page', data.previous_page);
                document.querySelector(next).setAttribute('data-page', data.next_page);
                let results = data.results;
                let r_length = results.length;

                let tableSelection = document.querySelector(selector);
                let tbody = tableSelection.querySelector('tbody');
                tbody.innerHTML = '';
                let rowFrag = document.createDocumentFragment();

                if (totalCount > 0) {
                    for (let x = 0; x < r_length; x++) {
                        let tr = document.createElement('tr');

                        let attr = results[x]['attr'];
                        let attr_length = attr.length;

                        if (attr_length > 0) {
                            for (let at = 0; at < attr_length; at++) {
                                tr.setAttribute(results[x]['attr'][at].name, results[x]['attr'][at].value);
                            }
                        }

                        for (let y = 0; y < columns.length; y++) {
                            let td = document.createElement('td');
                            if (columns[y].raw != undefined) {
                                td.innerHTML = columns[y].raw(results[x]);
                            } else {
                                if (results[x]['columns'][columns[y].data] != undefined) {
                                    td.innerHTML = results[x]['columns'][columns[y].data];
                                }
                            }
                            tr.appendChild(td)
                        }
                        rowFrag.appendChild(tr);
                    }
                }else{
                    let tr = document.createElement('tr');
                    let td = document.createElement('td');
                    td.setAttribute('colspan', columns.length);
                    td.setAttribute('style', 'text-align:center');
                    td.textContent = 'No Data Found';
                    tr.appendChild(td);
                    rowFrag.appendChild(tr);

                }
                tbody.appendChild(rowFrag);
                let countShow = tableSelection.closest('div').querySelector('.show-count');
                if (countShow) {
                    countShow.remove();
                }
                //total Count Show
                let countRowFrag = document.createDocumentFragment();
                let countDiv = document.createElement('div');
                countDiv.setAttribute('class', 'text-end show-count');
                countDiv.innerHTML = `Showing <span>${data.max}</span> of <span>${totalCount}</span>`;
                countRowFrag.appendChild(countDiv);
                tableSelection.after(countRowFrag);
                document.querySelector(next).disabled = !!data.disable_next;
                document.querySelector(prev).disabled = !!data.disable_prev;
            })
        } else {
            result.json().then(function (data) {
                alert('Ajax Error!');
            })
        }
    })
        .catch(function (error) {
            // console.log(error);
            return false;
        });

    return this;
}

DatatableInit.prototype.setSearchButton = function (selector) {
    let formData = this.data;
    let currentProto = this;
    let timer;

    if(document.querySelector(selector)){
        document.querySelector(selector).addEventListener('keyup', function(){
            clearTimeout(timer);
            let value = this.value;
            timer = setTimeout(function() {
                formData.set('search', value);
                formData.set('page', 1);
                currentProto.run();
            }, 200);
        })
    }
    return this;
}

DatatableInit.prototype.setupChangePage = function(prev, next) {
    let formData = this.data;
    let currentProto = this;

    if(document.querySelector(prev)){
        document.querySelector(prev).addEventListener('click', function(){
            formData.set('page', this.getAttribute('data-page'));
            currentProto.run();
        })

        document.querySelector(next).addEventListener('click', function(){
            formData.set('page', this.getAttribute('data-page'));
            currentProto.run();
        })
    }
}

DatatableInit.prototype.reload = function(){
    this.run();
}

document.querySelector('.table-responsive').addEventListener('show.bs.dropdown', function(){
    document.querySelector('.table-responsive').style.overflow = 'inherit';
})

document.querySelector('.table-responsive').addEventListener('hide.bs.dropdown', function(){
    document.querySelector('.table-responsive').style.overflow = 'auto';
})
