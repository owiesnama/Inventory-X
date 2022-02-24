<div class="flex flex-col">
  <!-- new Table -->
  <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
      @if (session()->has('message'))
      @endif
      <div class="mb-4 overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                Title</th>
                <th scope="col"
                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                Address</th>
              <th scope="col" class="relative px-6 py-3 text-right">
                <button class="px-6 py-2 text-white bg-indigo-600 rounded hover:bg-indigo-900"
                  wire:click="toggleAddingModal">New
                  Storage</button>
              </th>

            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            @foreach ($storages as $storage)
            <tr :wire:key="'storage-'.$storage->id">
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                  <div class="ml-4">
                    <div class="text-sm font-medium text-gray-900">{{ $storage->title }}</div>
                    
                  </div>
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900">{{ $storage->Address }}</div>
            </td>
         
              <td class="px-6 py-4 whitespace-nowrap">
                <span class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">
                  Available </span>
              </td>
              <td class="px-6 py-4 space-x-4 text-sm font-medium text-right whitespace-nowrap">
                <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                <a href="#" class="text-red-600 hover:text-red-900"
                  wire:click="confirmingDeletion({{ $storage }})">Delete</a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      {{ $storages->links() }}
    </div>
  </div>
  <!-- End new Table -->



  <!-- Storage modal form -->
  <form wire:submit.prevent="store()" method="post">
    <x-jet-dialog-modal wire:model="isAddingNewItem">
      <x-slot name="title">
        New Storage
      </x-slot>
      <x-slot name="content">
        <div class="space-y-4">
          <x-jet-validation-errors></x-jet-validation-errors>
          <div class="space-y-1">
            <x-jet-label for="name" value="{{ __('Name') }}" />
            <x-jet-input id="name" class="block w-full mt-1" type="text" inputmode="numeric" wire:model="storage.title"
              name="title" autofocus x-ref="name" autocomplete="one-time-code" />
          </div>
          <div class="space-y-1">
            <x-jet-label for="address" value="{{ __('Address') }}" />
            <x-jet-input id="address" class="block w-full mt-1" type="text" inputmode="numeric" wire:model="storage.Address"
              name="Address" x-ref="name" />
          </div>
   
        </div>
      </x-slot>
      <x-slot name="footer">
        <button class="px-6 py-2 text-white bg-indigo-600 rounded hover:bg-indigo-900" type="submit">Save
          Storage</button>
        <button class="px-6 py-2 text-gray-600 rounded" wire:click="toggleAddingModal()" type="button">Cancel</button>
      </x-slot>
    </x-jet-dialog-modal>
  </form>


  <!-- End Storage modal form -->
  <!-- Delete Model -->
  <form method="post" wire:submit.prevent="destroy()">
    <x-jet-confirmation-modal wire:model="isDeleting">
        <x-slot name="title">
            Are you sure you want to delete <strong>{{ optional($itemToDelete)['name'] }}</strong>
        </x-slot>
        <x-slot name="content">
        </x-slot>
        <x-slot name="footer">
            <button class="px-6 py-2 text-white bg-red-600 rounded hover:bg-red-900" type="submit">Delete
                Storage</button>
            <button class="px-6 py-2 text-gray-600 rounded" wire:click="$set('isDeleting', false)"
                type="button">Cancel</button>
        </x-slot>
    </x-jet-confirmation-modal>
</form>

  <!-- End Delete Model -->



</div>