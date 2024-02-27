<!-- <config>{!! json_encode([
		'format' => [85, 54]
	]) !!}</config> -->
    <style>
    div	{
        font-size: 13px;
        font-weight: bold;
    }
</style>



<div style="position:absolute; right:10px; top:10px;">
    
</div>
<div style="position:absolute; right:90px; top:30px; width: 220px;">
	Name :{{ $user->name }}
</div>

<div style="position:absolute; right:90px; top:60px; width: 220px;">
	Last Name :{{ $user->last_name }}
</div>
<div style="position:absolute; right:90px; top:80px; width: 220px;">
	Email Address :{{ $user->email }}
</div>

<div style="position:absolute; right:100px; top:125px; width: 220px;">
    <b></b>
	<barcode code="{{url('/')}}/users/idCard/<?= $user->id_card ?>" size="0.9" type="QR" error="M" class="barcode" style="border:2px solid #774c29" />
    <b></b>
</div>

