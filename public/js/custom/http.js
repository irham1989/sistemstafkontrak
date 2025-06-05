function Http(){}

Http.prototype.fetch = async function({method = 'GET', url = '', data = new FormData, callback = function(){}}){
    let f = await fetch(url, {
        method: method,
        body: data,
        headers: {
            'Accept': 'application/json',
        },
    }).then(function(result) {
        if(result.ok){
            result.json().then(function(json){
                return callback({
                    'status' : true,
                    'data' : json
                });
            })
        }else{
            result.json().then(function(json){
                return callback({
                    'status' : false,
                    'data' : typeof json == 'string' ? json : json.message
                });
            })
        }
    })
    .catch(function(error) {
        console.log('WHOOPS!');
        return false;
    });
}