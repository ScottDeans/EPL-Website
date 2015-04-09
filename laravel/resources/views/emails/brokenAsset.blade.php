Hello,

This is an automated notice that {!! $key['name'] !!} at branch {!! $key['user_branch'] !!} has reported asset #{!! $key['asset_tag'] !!} ({!! $key['description'] !!}) in kit #{!! $key['barcode'] !!} as broken. The kit is currently @if($key['status'] == 1){!! 'in transit to branch '.$key['branch_code'] !!} @else{!! 'idle at branch '.$key['user_branch'] !!}@endif.

While it is being repaired, the asset can be removed and replaced by selecting the kit in the "Kits" section, then selecting "Edit Kit".

Thank you, and have a nice day! 
