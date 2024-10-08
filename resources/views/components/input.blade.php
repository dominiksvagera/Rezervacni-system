<div class="relative z-10 h-auto p-8 py-10 overflow-hidden bg-white border-b-2 border-gray-300 rounded-lg shadow-2xl px-7" data-rounded="rounded-lg" data-rounded-max="rounded-full">
                       
    <input {{$atributes}} 
        class="block w-full px-4 py-3 mb-4 border border-2 border-transparent border-gray-200 rounded-lg focus:ring focus:ring-blue-500 focus:outline-none" data-rounded="rounded-lg" data-primary="blue-500" >
                        
         @error($attributes['name'])
    <div class="alert alert-danger text-sm text-red-400">{{ $message }}</div>
        @enderror
</div>