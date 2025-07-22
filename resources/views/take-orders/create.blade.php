<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-100 leading-tight">
            {{ __('Toma de pedidos') }}
        </h2>
    </x-slot>

    <div class="pt-6 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-6">
            <select
                onchange="if(this.value) { window.location.href='/orders/take/tables/'+this.value; }"
                class="block w-full sm:w-1/2 md:w-1/3 mx-auto bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-gray-100 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">

                <!-- Opción del placeholder (versión corregida y segura) -->
                <option value="" disabled {{ !optional($selectedTable)->id ? 'selected' : '' }}>
                    {{ __('Selecciona una mesa') }}
                </option>

                @foreach($tables as $table)
                    <!-- Opciones de las mesas (versión corregida y segura) -->
                    <option value="{{ $table->id }}"
                        {{ optional($selectedTable)->id == $table->id ? 'selected' : '' }}>
                        {{ $table->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div x-data="takeOrders" class="space-y-8">
        <!-- Menú -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                <template x-for="entry in menuEntries" :key="entry.id">
                    <div
                        class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg hover:shadow-xl transition p-6 flex flex-col justify-between">
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100" x-text="entry.name"></h3>
                            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400" x-text="entry.description"></p>
                        </div>
                        <div class="mt-4 flex items-center justify-between">
                            <span class="text-lg font-semibold text-indigo-600 dark:text-indigo-400"
                                  x-text="`S/ ${entry.price.toFixed(2)}`"></span>
                            <template x-if="!isMenuEntrySelectedTable(entry)">
                                <button @click="addToOrder(entry, 1)"
                                        class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-lg transition">
                                    {{ __('Añadir') }}
                                </button>
                            </template>
                        </div>
                    </div>
                </template>
            </div>
        </section>

        <!-- Carrito de pedidos -->
        <section class="mt-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <div class="grid grid-cols-5 gap-4 text-gray-700 dark:text-gray-300 font-semibold">
                        <div>{{ __('Descripción') }}</div>
                        <div class="text-center">{{ __('Precio') }}</div>
                        <div class="text-center">{{ __('Cantidad') }}</div>
                        <div class="text-center">{{ __('Notas') }}</div>
                        <div class="text-center">{{ __('Acciones') }}</div>
                    </div>
                </div>
                <div class="divide-y divide-gray-200 dark:divide-gray-700">
                    <template x-for="order in selectedTable.orders" :key="order.id">
                        <div class="px-6 py-4 grid grid-cols-5 gap-4 items-center">
                            <div class="text-gray-900 dark:text-gray-100" x-text="order.menu_entry.name"></div>
                            <div class="text-center text-indigo-600 dark:text-indigo-400"
                                 x-text="`S/ ${order.menu_entry.price.toFixed(2)}`"></div>
                            <div class="text-center text-gray-800 dark:text-gray-200" x-text="order.quantity"></div>
                            <div class="flex flex-col">
                                <textarea
                                    x-model="order.notes"
                                    class="bg-white dark:bg-gray-700
                                   text-gray-800 dark:text-gray-200
                                     resize-none border border-gray-300 dark:border-gray-600
                                     rounded-md px-2 py-1
                                     focus:ring-2 focus:ring-indigo-500 transition" rows="2">
                                </textarea>
                                <button @click="updateOrder(order, { notes: order.notes })"
                                        class="mt-2 self-end bg-indigo-600 hover:bg-indigo-700 text-white py-1 px-3 rounded-md transition text-sm">
                                    {{ __('Actualizar') }}
                                </button>
                            </div>
                            <div class="text-center space-x-1">
                                <button @click="updateOrder(order, { quantity: order.quantity + 1 })"
                                        class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-1 px-3 rounded-lg transition">
                                    +
                                </button>
                                <button @click="updateOrder(order, { quantity: order.quantity - 1 })"
                                        class="inline-block bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-3 rounded-lg transition">
                                    –
                                </button>
                            </div>
                        </div>
                    </template>
                </div>
            </div>

            <div class="py-6">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <button @click="clearTable" class="bg-blue-950 text-white px-5 rounded">Limpiar mesa</button>
                </div>
            </div>
        </section>
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
                        .then(({ data: resp }) => {
                            if (resp.deleted) {
                                this.selectedTable.orders = this.selectedTable.orders
                                    .filter(o => o.id != order.id);
                            } else {
                                order.quantity = resp.quantity;
                                order.notes    = resp.notes;
                            }
                        })
                        .catch(error => console.error('Error updating order:', error));
                },

                clearTable(){
                    axios.delete('/orders/tables/' + this.selectedTable.id)
                        .then(response =>{
                            this.selectedTable.orders = [];
                        });
                }
            }))
        })
    </script>
</x-app-layout>
