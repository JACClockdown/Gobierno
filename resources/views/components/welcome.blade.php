<main class="w-full md:w-[calc(100%-256px)] md:ml-64 bg-gray-200 min-h-screen transition-all main">
    
    <x-navbar></x-navbar>

  <!-- Content -->
    <div class="p-6">
        <div class=" mb-6">
            <div class="bg-white border border-gray-100 shadow-md shadow-black/5 p-6 rounded-md">
                
                <div class="flex justify-between mb-4 items-start">
                    <a href="{{ route('create') }}">
                        <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Add Item
                        </button>
                    </a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full min-w-[460px]">
                        <thead>
                            <tr>
                                <th class="text-[12px] uppercase tracking-wide font-medium text-gray-400 py-2 px-4 bg-gray-50 text-left rounded-tl-md rounded-bl-md">ID</th>
                                <th class="text-[12px] uppercase tracking-wide font-medium text-gray-400 py-2 px-4 bg-gray-50 text-left rounded-tl-md rounded-bl-md">Name</th>
                                <th class="text-[12px] uppercase tracking-wide font-medium text-gray-400 py-2 px-4 bg-gray-50 text-left">Description</th>
                                <th class="text-[12px] uppercase tracking-wide font-medium text-gray-400 py-2 px-4 bg-gray-50 text-left rounded-tr-md rounded-br-md">Price</th>
                                <th class="text-[12px] uppercase tracking-wide font-medium text-gray-400 py-2 px-4 bg-gray-50 text-left rounded-tr-md rounded-br-md">Quality</th>
                                <th class="text-[12px] uppercase tracking-wide font-medium text-gray-400 py-2 px-4 bg-gray-50 text-left rounded-tr-md rounded-br-md">Status Active</th>
                                <th class="text-[12px] uppercase tracking-wide font-medium text-gray-400 py-2 px-4 bg-gray-50 text-left rounded-tr-md rounded-br-md">Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($items as $item)
                                <tr>
                                    <td class="py-2 px-4 border-b border-b-gray-50"> 
                                        {{ $item->id }}
                                    </td>
                                    <td class="py-2 px-4 border-b border-b-gray-50">
                                        {{ $item->name }}
                                    </td>
                                    <td class="py-2 px-4 border-b border-b-gray-50">
                                        {{ $item->description }}
                                    </td>
                                    <td class="py-2 px-4 border-b border-b-gray-50">
                                        <span class="text-[13px] font-medium text-emerald-500"> ${{ $item->price }}</span>
                                    </td>
                                    <td class="py-2 px-4 border-b border-b-gray-50">
                                        {{ $item->amount }}
                                    </td>
                                    <td>
                                        @if($item->status == 1)
                                            <span class="text-[13px] font-medium text-emerald-500"> Active </span>
                                        @else
                                            <span class="text-[13px] font-medium text-red-500"> No Active </span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('me',$item->id) }}">
                                            <button
                                                type="button"
                                                class="text-white bg-yellow-400 hover:bg-yellow-500 focus:outline-none focus:ring-4 focus:ring-yellow-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:focus:ring-yellow-900"
                                            >Update</button>
                                        </a>
                                        &nbsp;
                                        <button
                                            type="button"
                                            data-id="{{ $item->id }}"
                                            class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900 deleteIcon"
                                        >Delete</button>
                                    </td>
                                </tr>
                            @empty
                                <p>
                                    No Data
                                </p>
                            @endforelse                        
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
  <!-- End Content -->
</main>
<script>
    $(document).on('click', '.deleteIcon', (e) => {

        e.preventDefault();

        const id = $('.deleteIcon').attr('data-id');

        let csrf = '{{ csrf_token() }}';

        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        })
        .then((res) => {

            if(res.isConfirmed){
                $.ajax({
                    url:  "/delete/"+id,
                    method: 'delete',
                    data: {
                        id: id,
                        _token: csrf
                    },
                    success: (response) => {
                        console.log(response)
                    },
                    error: (error) => {
                        console.error(error)
                    }
                })
            }

        })
    })
</script>