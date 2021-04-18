<template>
    <div class="col-md-3 p-0">
        <div class="card" v-bind:style="{ backgroundColor: this.color }">
            <div class="card-header">
                <h2>
                    {{ name }}
                    <button @click="deleteComponent" class="btn btn-danger">Del</button>
                </h2>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <input v-model="content" type="text" class="col-9 rounded-0 form-control">
                    <button v-on:click="addNewTodo" type="button" class="col rounded-0 btn btn-info">Add</button>
                </div>
                <todo
                    v-for="(item, index) in todos_list"
                    v-bind:key="index"
                    v-bind:id="item.id"
                    v-bind:array_key="index"
                    v-bind:todo_board_id="item.todo_board_id"
                    v-bind:content="item.content"
                />
            </div>
        </div>
    </div>
</template>

<script>
import Todo from "./todo"

export default {
    name: "todo-board-item",
    props: ["id", "name", "color", "array_key"],
    data() {
        return {
            content: "",
        };
    },
    computed: {
        todos_list() {
            let items = this.$store.state.todos_list;
            let new_items = [];
            for (let i = 0; i < items.length; i++)
                if (items[i].todo_board_id === this.id)
                    new_items.push(items[i]);
            return new_items;
        }
    },
    mounted() {
        this.$store.dispatch("getAllTodos", this.id);
    },
    methods: {
        deleteComponent() {
            this.$store.dispatch("deleteFromTodoBoardsList", {key: this.array_key, id: this.id});
        },
        addNewTodo() {
            this.$store.dispatch("addNewTodo", {content: this.content, todo_board_id: this.id});
            this.content = "";
        },
    },
    components: {Todo},
}
</script>

<style scoped>
.card {
    min-height: 20em;
    margin-bottom: 0;
}
</style>
