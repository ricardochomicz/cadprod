<template>
    <div>
        <button
            class="btn btn-sm btn-primary mb-2"
            type="button"
            @click="addCampos"
        >
            Adicionar
        </button>
        <div
            class="row"
            v-for="(order, index) in orders"
            v-bind:key="`${index}`"
        >
            <div class="col-sm-4">
                <select
                    name="product_id[]"
                    class="form-control mb-1"
                    v-model="order.id"
                    @change="onChange($event, index)"
                >
                    <option value="">Produto</option>
                    <option
                        :value="product.id"
                        v-for="product in products"
                        :key="product.name"
                        v-bind:selected="order"
                    >
                        {{ product.name }}
                    </option>
                </select>
            </div>

            <div class="col">
                <div class="input-group col">
                    <div class="input-group-prepend">
                        <button
                            style="min-width: 2.5rem"
                            class="btn btn-decrement btn-outline-secondary btn-minus"
                            type="button"
                            v-on:click="decrease(index)"
                        >
                            <strong>−</strong>
                        </button>
                    </div>
                    <input
                        type="text"
                        inputmode="decimal"
                        style="text-align: center"
                        class="form-control"
                        name="qty[]"
                        v-model="order.pivot.qty"
                    />
                    <div class="input-group-append">
                        <button
                            style="min-width: 2.5rem"
                            class="btn btn-increment btn-outline-secondary btn-plus"
                            type="button"
                            v-on:click="increase(index)"
                        >
                            <strong>+</strong>
                        </button>
                    </div>
                </div>
            </div>
            <div class="col">
                <input
                    type="text"
                    class="form-control mb-1"
                    name="price[]"
                    placeholder="Preço"
                    v-model="order.price"
                />
            </div>
            <div class="col">
                <input
                    type="text"
                    class="form-control mb-1"
                    name="subtotal"
                    placeholder="SubTotal"
                    v-model="order.subtotal"
                    readonly
                />
            </div>
            <div class="col">
                <button class="btn btn-danger" v-on:click="deleteCampos(index)">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </div>
        </div>

        <div class="form-inline">
            <label for="" class="mr-3">Total</label>
            <input
                type="hidden"
                class="form-control border-0 font-weight-bold"
                name="total"
                id="total"
                v-model="total"
            />
            R$ {{ formatPrice(total) }}
        </div>
    </div>
</template>

<script>
export default {
    created() {
        this.getProducts();
        this.getProductsOrder();
    },

    data() {
        return {
            orders: [],
            //qty: 0,
            total: 0,
            id: "",
            selectedProduct: "",
            products: [],
        };
    },
    methods: {
        increase: function (index) {
            this.orders[index].qty++;
            this.orders[index].subtotal =
                this.orders[index].qty * this.orders[index].price;

            this.total += parseFloat(this.orders[index].price);
        },
        decrease: function (index) {
            this.orders[index].qty--;
            this.orders[index].subtotal =
                this.orders[index].qty * this.orders[index].price;
            this.total -= parseFloat(this.orders[index].price);
        },
        formatPrice(value) {
            let val = (value / 1).toFixed(2).replace(".", ",");
            return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        },
        addCampos() {
            this.orders.push({
                products: [],
                selectedProduct: "",
                price: "",
                qty: "",
                subtotal: "",
            });
        },
        deleteCampos(index) {
            this.total -= parseFloat(this.orders[index].price);
            this.orders.splice(index, 1);
        },
        calculaTotal(index) {
            this.orders[index].subtotal =
                this.orders[index].qty * this.orders[index].price;
            this.total += this.orders[index].subtotal;
        },
        onChange(event, index) {
            this.id = event.target.value;
            Object.values(this.products).forEach((value) => {
                if (value.id == this.id) {
                    this.orders[index].price = value.price;
                }
            });
        },
        getProducts() {
            axios.get("/api/vproducts").then((response) => {
                this.products = response.data;
            });
        },
        getProductsOrder() {
            axios.get("/api/vproducts/218/show").then((response) => {
                this.orders = response.data;
                console.log(this.orders);
            });
        },
    },
};
</script>