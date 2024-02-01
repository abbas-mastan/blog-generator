@extends('app')
@section('content')
    <form action="{{ route('blog') }}" method="POST" class="flex justify-center blogForm">
        @csrf
        <div class="space-y-12 w-[50%]">
            <div class="border-b border-gray-900/10 pb-12">
                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-4">
                        <label for="username" class="block text-sm font-medium leading-6 text-gray-900">Set blog post
                            title</label>
                        <div class="mt-2">
                            <div
                                class="flex  shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                <input type="text" name="title" id="title"
                                    value="{{ isset($title) ? $title : '' }}"
                                    class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                    placeholder="Enter title here">
                            </div>
                        </div>
                        {{-- <div class="sm:col-span-4">
                        <label for="username" class="block text-xs font-medium leading-6 text-gray-900">Scrap SERP
                            or Add Global background (both optionsal)</label>
                        <div class="mt-2">
                            <div
                                class="flex shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                <input type="button" name="summary" value="SERP scraping Enabled"
                                    class="block flex-1 border-0  py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6">
                            </div>
                        </div>
                    </div> --}}

                        <div class="col-span-full">
                            <label for="about" class="block text-sm font-medium leading-6 text-gray-900">Global
                                background</label>
                            <div class="mt-2">
                                <textarea disabled id="summary" name="summary" rows="3"
                                    class="block w-full border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                @foreach ($summaries as $summary)
{{ $summary }}
@endforeach
                            </textarea>
                            </div>
                        </div>
                        <div class="sm:col-span-4">
                            <label for="username" class="block text-sm font-medium leading-6 text-gray-900">Set # of H2
                                subheading</label>
                            <div class="flex justify-between">
                                <div class="mt-2 w-[50%]">
                                    <div
                                        class="flex  shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                        <input type="number" name="h2" value="1"
                                            class="h2 block w-3 flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6">
                                    </div>
                                </div>
                                <div class="mt-2 w-[50%]">
                                    <div
                                        class="flex  shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                        <input type="button" name="h1" value="Create H2"
                                            class="h2Button block w-3 flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="h2container">

                        </div>
                        <div class="sm:col-span-4">
                            <label for="username" class="block text-sm font-medium leading-6 text-gray-900">Set
                                subheading data</label>
                            <div class="mt-2">
                                <div
                                    class="flex  shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                    <input type="number" name="h3"
                                        class="block w-3 flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6">
                                </div>
                            </div>
                        </div>
                        <div class="mt-6 flex items-center justify-end gap-x-6">
                            {{-- <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button> --}}
                            <button type="submit"
                                class=" bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Start
                                Scraping</button>
                        </div>
                    </div>

    </form>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('.h2Button').click(function(e) {
                e.preventDefault();
                $('.h2container').empty();
                var quantity = $('.h2').val();
                for (let index = 1; index <= quantity; index++) {
                    // Create a new h2 element
                    var newH2 = $('<h2>').text('Heading ' + index);

                    // Append the new h2 element to a container (replace 'yourContainerId' with the actual ID)
                    $('.h2container').append(`
                    <div class="flex justify-between">
                    <div class="mt-2 w-[10%] bg-indigo-600 text-white">
                            <div class="flex  shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                              <input type="button" name="h2" value="H2${index}" class=" block w-3 flex-1 border-0 bg-indigo rounded-0 py-1.5 pl-1 text-white placeholder:text-white  sm:leading-6">
                            </div>
                          </div>
                          <div class="mt-2 w-[90%]">
                            <div class="flex  shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                              <input type="text" name="headings[]" class="h2Button ${'heading'+index} block w-3 flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6">
                            </div>
                            </div>
                          </div>
          
                `);
                }
                $('.h2container').append(`<div class="mt-6 flex items-center justify-end gap-x-6">
          <button class="generateHeadings bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Generate Headings</button>
          </div>
         `);
            });

            $(document).on('click', '.generateHeadings', function(e) {
                e.preventDefault();
                $('.generateHeadings').addClass('hidden');
                $('.h2container').append(`
                <button type="submit" class="bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Generate Blog</button>
            `);
                $('.blogForm').attr('action', "{{ route('generateBlog') }}");
                var quantity = parseInt($('.h2').val()); // Get the value and convert it to a number
                @isset($headings)
                    var headingsarray = @json($headings);
                @endisset
                var selectedHeadings = headingsarray.slice(0, quantity);
                $.each(selectedHeadings, function(indexInArray, heading) {
                    indexInArray++;
                    $('.heading' + indexInArray).val(heading);
                });
            });
        });

        // $(document).on('click', '.generateBlog', function(e) {
        //     e.preventDefault();
        //     $.ajaxSetup({
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         }
        //     });

        //     $.ajax({
        //         data: $('.blogForm').serialize(),
        //         url: "{{ route('generateBlog') }}",
        //         type: "POST",
        //         dataType: 'json',
        //         success: function(data) {
        //             console.log(data);
        //         },
        //         error: function(data) {
        //             console.log('Error:', data);
        //             $('#saveBtn').html('Save Changes');
        //         }
        //     });
        // });
    </script>
@endsection
