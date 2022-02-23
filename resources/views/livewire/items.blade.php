<div>
  <!-- Items Form -->
  <div class="w-full max-w-xs">
    <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" wire:submit.prevent='AddItem'>
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="item">
          Name Of Item
        </label>
        <input
          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none "
          id="item" type="text" placeholder="Name" wire:model.debounce="state.name">
      </div>
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="price">
          Price
        </label>
        <input
          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none "
          id="price" type="text" placeholder="USD" wire:model.debounce="state.price">
      </div>
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="cost">
          Cost
        </label>
        <input
          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none "
          id="cost" type="text" placeholder="Cost" wire:model.debounce="state.cost">
      </div>
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="expired">
          Expire Date
        </label>
        <input
          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none "
          id="expired" type="text" placeholder="Expire Date" wire:model.debounce="state.expired">
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


  <!-- Items Table -->

  <div class="flex flex-col">





    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div class="inline-block py-2 min-w-full sm:px-6 lg:px-8">
        <div class="overflow-hidden shadow-md sm:rounded-lg">
          <table class="min-w-full">
            <thead class="bg-gray-50 dark:bg-gray-700">
              <tr>
                <th scope="col"
                  class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                  Name
                </th>
                <th scope="col"
                  class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                  Price
                </th>
                <th scope="col"
                  class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                  Cost
                </th>
                <th scope="col"
                  class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                  Expire_Date
                </th>
                <th scope="col" class="relative py-3 px-6">
                  <span class="sr-only">Actions</span>
                </th>
              </tr>
            </thead>
            <tbody>
              @forelse ($items as $item)
              <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                  {{ $item->name }}
                </td>
                <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
                  {{ $item->price }}
                </td>
                <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
                  {{ $item->cost }}
                </td>
                <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
                  {{ $item->expire_date }}
                </td>
                <td class="py-4 px-6 text-sm font-medium text-right whitespace-nowrap">
                  <button  class="text-blue-600 dark:text-blue-500 hover:underline" wire:click.prevent="delete({{ $item->id }})">Delete</button>
                </td>
              </tr>

              @empty
              <tr>
                <td>
                  <p>There Is No Items</p>
                </td>
              </tr>
              @endforelse




            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <!-- Items Form Ends -->

  

</div>