@php
use Spatie\MediaLibrary\MediaCollections\Models\Media;
if(auth()->user()->id!=1){
$media = Media::where('model_id',auth()->user()->company_id)->first();
$imagePath = '/'.$media->id.'/'.$media->file_name;
}
@endphp 
<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
              @if (auth()->user()->id!=1)
                   <img
            src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path().'/storage'.$imagePath)) }}"
            width="65"
        >
              @endif   
           
              

    </div>
    <div class="sidebar-brand sidebar-brand-sm">
       
    </div>
    <ul class="sidebar-menu">
        @include('backend.layouts.menu')
    </ul>
</aside>
