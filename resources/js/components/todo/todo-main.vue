<template>
    <div>
        <router-link class="nav-link" to="/">Back</router-link>
        <div class="container">
            <div class="row card-columns">
                <todo-board
                    v-for="(item, index) in todo_boards_list"
                    v-bind:key="index"
                    v-bind:array_key="index"
                    v-bind:color="item.color"
                    v-bind:name="item.name"
                    v-bind:id="item.id"
                />
                <button v-if="!is_add_new_todo_board" v-on:click="is_add_new_todo_board = true"
                        class="col-md-3 btn btn-primary rounded-0 add"><h4>Add
                    todo board</h4></button>
                <div class="card col-md-3 p-0" v-bind:style="{ backgroundColor: new_todo_board.color }"
                     v-if="is_add_new_todo_board">
                    <div class="card-header">
                        <h4>Name</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <input v-model="new_todo_board.name" type="text" class="form-control">
                        </div>
                        <div class="form-group pt-2">
                            <input v-model="new_todo_board.color" type="color" class=" mr-3 form-control">
                        </div>
                        <div class="form-group pt-2">
                            <button class="btn btn-success" v-on:click="createNewTodoBoard">Add</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import todoBoard from "./todo_board"


export default {
    name: "todo-main",
    props: ["id"],
    data() {
        return {
            is_add_new_todo_board: false,
            new_todo_board: {
                color: 0x0,
                name: "",
                board_id: this.id,
            },
        };
    },
    computed: {
        todo_boards_list() {
            return this.$store.getters.getTodoBoardsList;
        },
    },
    mounted() {
        this.$store.dispatch("getAllTodoBoards", this.id);
    },
    methods: {
        createNewTodoBoard() {
            this.is_add_new_todo_board = false;
            if (this.new_todo_board.name === "" || this.new_todo_board.color === 0)
                return
            this.$store.dispatch("addNewTodoBoard", this.new_todo_board);
            this.new_todo_board = {
                color: 0x0,
                name: "",
                board_id: this.id,
            }
        },
    },
    beforeRouteLeave(to, from, next){
        this.$store.dispatch("clearAllTodoBoards");
        next();
    },
    components: {todoBoard},
}
</script>

<style scoped>
.add {
    min-height: 20em;
}

.card {
    min-height: 20em;
    margin-bottom: 0;
}
</style>
