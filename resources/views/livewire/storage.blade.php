<div>
    <!-- Storage Form -->
    <div class="w-full max-w-xs">
      <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" wire:submit.prevent='AddStorage'>
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="item">
            Title
          </label>
          <input
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none "
            id="item" type="text" placeholder="Name" wire:model.debounce="state.title">
        </div>
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="price">
            Address
          </label>
          <input
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none "
            id="price" type="text" placeholder="Address" wire:model.debounce="state.Address">
        </div>
        
  
  
  
        <div class="flex items-center justify-between">
          <button
            class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
            type="submit">
            ADD
          </button>
  
        </div>
      </form>
  
    </div>
  
  
    <!-- Storage Table -->
  
    <div class="flex flex-col">
      <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block py-2 min-w-full sm:px-6 lg:px-8">
          <div class="overflow-hidden shadow-md sm:rounded-lg">
            <table class="min-w-full">
              <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                  <th scope="col"
                    class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                    Title
                  </th>
                  <th scope="col"
                    class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                    Address
                  </th>
              
  
                  <th scope="col" class="relative py-3 px-6">
                    <span class="sr-only">Actions</span>
                  </th>
                </tr>
              </thead>
              <tbody>
                @forelse ($storage as $item)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                  <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ $item->title }}
                  </td>
                  <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
                    {{ $item->Address }}
                  </td>
           
                  <td class="py-4 px-6 text-sm font-medium text-right whitespace-nowrap">
                    <button class="text-blue-600 dark:text-blue-500 hover:underline"
                      wire:click.prevent="delete({{ $item->id }})">Delete</button>
                  </td>
                </tr>
  
                @empty
                <tr>
                  <td>
                    <p>There Is No Storage</p>
                  </td>
                </tr>
                @endforelse
  
  
  
  
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  
    <!-- Storage Form Ends -->
  
  
  
  </div>