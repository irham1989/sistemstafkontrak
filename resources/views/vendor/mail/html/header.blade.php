@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="https://ekedatanganv2.ikma.edu.my/media/logos/logo-ikkm.png" class="logo" alt="IKMa Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
