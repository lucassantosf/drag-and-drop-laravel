<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gallery Upload') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                 
                @include('components.alert_messages') 

                <div class="p-6 bg-white">
                    <form action="{{route('gallery.store')}}" class="dropzone" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="fallback">
                            <div class="dz-message needsclick" data-dz-message><span>Your Custom Message</span></div>
                            <input name="file" type="file" multiple="multiple">
                        </div>
                    </form> 
                </div>

                <div class="bg-white flex justify-center">
                    <a href="{{route('gallery.index')}}" class="bg-info border border-transparent rounded-md inline-flex items-center px-4 py-1">Atualizar imagens</a>
                </div>

                <div class="p-6 bg-white grid grid-cols-3 gap-4"> 

                    @if(count($files)>0)
                        @foreach($files as $file)
                        <div class="p-2 mt-4 image" style="background: url('{{$file->file_url}}')">
                            <div class="image-form"> 
                                <form action="{{route('gallery.destroy',$file->id)}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="_method" value="DELETE"/>
                                    <button type="submit" class="btn btn-danger">X</button>
                                </form>
                            </div> 
                            <input type="text" class="image-input {{!empty($file->label) ? 'border-none' : '' }}" data-file="{{$file->id}}" @if(!empty($file->label)) value="{{$file->label}}" @else placeholder="Nome da imagem" @endif >
                        </div>
                        @endforeach
                    @endif

                </div>

            </div>
        </div>
    </div>

    <link href="{{  URL::asset('js/dropzone/dist/dropzone.css')}}" rel="stylesheet" type="text/css">
    <script src="{{ URL::asset('js/dropzone/dist/dropzone.js')}}"></script> 

    <script>
        Dropzone.autoDiscover = false;

        var dropzone = new Dropzone('.dropzone', {
            previewsContainer: '.dropzone',
            dictDefaultMessage: 'Arraste e solte imagens para upload',
            dictFallbackText: 'Houve um erro ao subir a imagem, tente novamente.',
            error: function(file, response, errors) {
                $(file.previewElement).find('.dz-error-message').text(response.errors.file).show().css('opacity', '1');
                $(file.previewElement).find('.dz-error-mark').show().css('opacity', '1');
            }
        });

        $(".image-input").on('blur',function(){
            var token =  $('input[name="_token"]').attr('value')
            var id = $(this).attr("data-file") 
            var label = this.value

            if(label.length === 0) {
                $(this).attr("placeholder", "Nome da Imagem")
                $(this).removeClass("border-none");
            }else{
                $(this).addClass("border-none"); 
            }

            $.ajax('{{route("gallery.update")}}', {
                type: "POST", 
                headers:{
                    'X-CSRF-Token': token 
                },
                data:{
                    id,
                    label
                },
                success: response => {  
                    console.log('response',response) 
                },
                error: (response,status) => {  
                    console.log('response',error)  
                }
            });  
        }); 
    </script>

</x-app-layout>
