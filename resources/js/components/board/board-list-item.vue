<template>
    <div class="col-md-3 p-0">
        <div class="card">
            <div class="card-header">
                <h2>{{ name }}</h2>
            </div>
            <div class="card-body">
                <p>{{ description }}</p>
            </div>
            <div class="card-footer">
                <router-link class="btn btn-primary rounded-0" :to="{name: 'boardId', params: {id: this.id}}">Show</router-link>
                <button v-on:click="show_modal_window = true" class="btn btn-danger rounded-0">Delete</button>
            </div>
        </div>
        <modal-window v-if="show_modal_window" v-bind:header="'Are you sure'"
                      v-bind:body="'What do you want to delete this board?'" @close="show_modal_window = false"
                      @action="del"/>

    </div>
</template>

<script>
import ModalWindow from "../../components/modal-window"

export default {
    name: "board-list-item",
    props: ["name", "description", "id", "array_id"],
    data() {
        return {
            show_modal_window: false,
        };
    },
    methods: {
        del() {
            this.show_modal_window = false;
            this.$emit("deleteItem", {id: this.id, key: this.array_id})
        },
    },
    components: {ModalWindow}
}
</script>

<style scoped>

</style>
