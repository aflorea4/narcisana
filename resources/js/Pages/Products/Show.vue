<template>
    <app-layout title="Products">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ product.name }}
            </h2>
        </template>

        <div>
            <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-2">
                <div
                    class="bg-white p-4 rounded-md text-lg w-full flex flex-col"
                >
                    <div class="flex">
                        <div class="flex-grow">Product name:</div>
                        <div class="flex-shrink-0">{{ product.name }}</div>
                    </div>
                    <div class="flex">
                        <div class="flex-grow">Product description:</div>
                        <div class="flex-shrink-0 max-w-lg text-right">
                            {{ product.description }}
                        </div>
                    </div>
                    <div class="flex">
                        <div class="flex-grow">Product price:</div>
                        <div class="flex-shrink-0">{{ product.price }} RON</div>
                    </div>
                    <div class="flex">
                        <div class="flex-grow">Product quantity:</div>
                        <div class="flex-shrink-0">
                            <input
                                class="w-full rounded-md"
                                type="number"
                                name="quantity"
                                placeholder="Enter quantity"
                                v-model="form.quantity"
                            />
                        </div>
                    </div>
                    <div class="flex mt-2">
                        <div class="flex-grow">
                            <button
                                class="w-full px-4 py-2 border-2 border-green-400 rounded-md hover:bg-green-400"
                                type="submit"
                                @click.stop="buy"
                            >
                                Buy Now
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import JetSectionBorder from "@/Jetstream/SectionBorder.vue";
import JetButton from "@/Jetstream/Button.vue";

export default defineComponent({
    props: ["product", "checkout_url"],

    components: {
        AppLayout,
        JetSectionBorder,
        JetButton,
    },

    data() {
        return {
            form: this.$inertia.form({
                quantity: 0,
            }),
        };
    },

    methods: {
        buy(id) {
            this.form.post(route("checkout.products", this.product.id));
        },
    },

    mounted() {
        if (this.checkout_url != null) {
            window.location.href = this.checkout_url;
        }
    },
});
</script>
