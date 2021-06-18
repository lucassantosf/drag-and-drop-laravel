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

                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{route('gallery.store')}}" class="dropzone" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="fallback">
                            <div class="dz-message needsclick" data-dz-message><span>Your Custom Message</span></div>
                            <input name="file" type="file" multiple="multiple">
                        </div>
                    </form> 
                </div>

                <a href="{{route('gallery.index')}}" class="btn btn-info"><i class="fas fa-sync-alt"></i> Atualizar imagens</a>

                <div class="p-6 bg-white border-b border-gray-200 grid grid-cols-8 gap-4">

                    @if(count($files)>0)
                        @foreach($files as $file)
                        <div>
                            <img src="{{$file->file_url}}" alt="{{$file->id}}" width="100%"/>
                            <form action="{{route('gallery.destroy',$file->id)}}" method="POST">
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="DELETE"/>
                                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Remover</button>
                            </form>
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
            dictDefaultMessage: 'Selecione as imagens para upload',
            dictFallbackText: 'Houve um erro ao subir a imagem, tente novamente.',
            error: function(file, response, errors) {
                $(file.previewElement).find('.dz-error-message').text(response.errors.file).show().css('opacity', '1');
                $(file.previewElement).find('.dz-error-mark').show().css('opacity', '1');
            }
        });
    </script>

</x-app-layout>
