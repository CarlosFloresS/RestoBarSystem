<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Toma de pedidos') }}
        </h2>
    </x-slot>

    <div class="pt-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <select onchange="window.location.href='/orders/take/tables/'+this.value" class="form-select">
            <option value="">Selecciona una mesa</option>
            @foreach($tables as $table)
                <option
                    value="{{$table->id}}" {{$selectedTable && $selectedTable->id == $table->id ? 'selected': ''}}>{{$table->name}}</option>
            @endforeach
        </select>
    </div>

    <div x-data="takeOrders">
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">

                        <div class="grid grid-cols-6 gap-5">
                            <template x-for="entry in menuEntries" :key="entry.id">
                                <div class="p-5 bg-indigo-300 rounded shadow-md">
                                    <div class="font-bold" x-text="entry.name"></div>
                                    <div class="text-sm text-gray-600" x-text="entry.description"></div>
                                    <div x-text="'S/'+entry.price"></div>
                                    <div>
                                        <template x-if="!isMenuEntrySelectedTable(entry)">
                                            <button @click="addToOrder(entry, 1)"
                                                    class="bg-blue-950 text-white px-5 rounded">Añadir
                                            </button>
                                        </template>
                                    </div>
                                </div>
                            </template>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">

                        <div class="space-y-2">
                            <div class="grid grid-cols-4 font-bold">
                                <div>Descripción</div>
                                <div class="text-center">Precio</div>
                                <div class="text-center">Cantidad</div>
                                <div class="text-center">Acciones</div>
                            </div>

                            <template x-for="order in selectedTable.orders" :key="order.id">
                                <div class="grid grid-cols-4">
                                    <div x-text="order.menu_entry.name"></div>
                                    <div class="text-center" x-text="'S/'+order.menu_entry.price"></div>
                                    <div class="text-center" x-text="order.quantity"></div>
                                    <div class="text-center">
                                        <button @click="updateOrder(order, {quantity: order.quantity + 1})"
                                                class="bg-blue-950 text-white px-5 rounded">+
                                        </button>
                                        <button @click="updateOrder(order, {quantity: order.quantity - 1})"
                                                class="bg-blue-950 text-white px-5 rounded">-
                                        </button>
                                    </div>
                                </div>
                            </template>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('takeOrders', () => ({
                menuEntries: {!! $menuEntries->toJson() !!},
                selectedTable: {!! $selectedTable->toJson() !!},

                isMenuEntrySelectedTable(entry) {
                    return this.selectedTable.orders.find(order => order.menu_entry_id == entry.id);
                },

                addToOrder(entry, quantity) {
                    axios.post('/orders/take/tables/' + this.selectedTable.id, {
                        menu_entry_id: entry.id,
                        quantity: quantity,
                    })
                        .then(response => {
                            this.selectedTable.orders.push(response.data);
                        })
                        .catch(error => {
                            console.error('Error adding order:', error);
                        });
                },

                updateOrder(order, data) {
                    axios.put('/orders/' + order.id, data)
                        .then(response => {
                            // Verificar si fue eliminado
                            if (response.data.deleted) {
                                let index = this.selectedTable.orders.findIndex(o => o.id == order.id);
                                if (index !== -1) {
                                    this.selectedTable.orders.splice(index, 1);
                                }
                            } else {
                                // Actualizar cantidad normalmente
                                order.quantity = response.data.quantity;
                            }
                        })
                        .catch(error => {
                            console.error('Error updating order:', error);
                        });
                }
            }))
        })
    </script>

</x-app-layout>
