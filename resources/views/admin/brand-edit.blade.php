@extends('layouts.admin')
@section('content')

<div class="main-content-inner">
    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap20 mb-27">
            <h3>Brand infomation</h3>
            <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                <li>
                    <a href="{{route('admin.index')}}">
                        <div class="text-tiny">Dashboard</div>
                    </a>
                </li>
                <li>
                    <i class="icon-chevron-right"></i>
                </li>
                <li>
                    <a href="{{route('admin.brand.add')}}">
                        <div class="text-tiny">Brands</div>
                    </a>
                </li>
                <li>
                    <i class="icon-chevron-right"></i>
                </li>
                <li>
                    <div class="text-tiny">Edit Brand</div>
                </li>
            </ul>
        </div>
        <!-- new-category -->
        <div class="wg-box">
            <form class="form-new-product form-style-1" action="{{route('admin.brand.update')}}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('put')
                <input type="hidden" name="id" value="{{$brand->id}}">
                <fieldset class="name">
                    <div class="body-title">Brand Name <span class="tf-color-1">*</span></div>
                    <input class="flex-grow" type="text" placeholder="Brand name" name="name"
                        tabindex="0" value="{{$brand->name}}" aria-required="true" required="">
                </fieldset>
                @error('name')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
                @enderror
                <fieldset class="name">
                    <div class="body-title">Brand Slug <span class="tf-color-1">*</span></div>
                    <input class="flex-grow" type="text" placeholder="Brand Slug" name="slug"
                        tabindex="0" value="{{$brand->slug}}" aria-required="true" required="">
                </fieldset>
                @error('slug')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
                @enderror
                <fieldset>
                    <div class="body-title">Upload images <span class="tf-color-1">*</span>
                    </div>
                    <div class="upload-image flex-grow">
                        @if ($brand->image)
                        <div class="item" id="imgpreview">
                            <img src="{{asset('uploads/brands')}}/{{$brand->image}}" class="effect8" alt="">
                        </div>
                        @endif
                        <div id="upload-file" class="item up-load">
                            <label class="uploadfile" for="myFile">
                                <span class="icon">
                                    <i class="icon-upload-cloud"></i>
                                </span>
                                <span class="body-text">Drop your images here or select <span
                                        class="tf-color">click to browse</span></span>
                                <input type="file" id="myFile" name="image" accept="image/*">
                            </label>
                        </div>
                    </div>
                </fieldset>
                @error('image')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
                @enderror

                <div class="bot">
                    <div></div>
                    <button class="tf-button w208" type="submit">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>



@endsection

@push('scripts')

<script>
    $(function(){
        $("#myFile").on("change",function(e){
            const photoInp =$("#myFile");
            const [file] =this.files;

            if(file){
                $("#imgpreview img").attr('src',URL.createObjectURL(file));
                $("#imgpreview").show();
            }

        });

        $("input[name='name']").on("change",function(){
            $("input[name='slug']").val(StringToSlug($(this).val()));
        });
    });

    function StringToSlug(Text)
    {
        return Text.toLowerCase()
        .replace(/[^\w ]+/g,"")
        .replace(/ +/g,"-");
    }
</script>

@endpush
