<template>
    <div id="board-list">
        <div class="container">
            <div class="row card-columns">
                <board-list-item
                    v-for="(item, index) in boards_list"
                    v-bind:name="item.name"
                    v-bind:description="item.description"
                    v-bind:key="index"
                    v-bind:id="item.id"
                    v-bind:array_id="index"
                    v-on:deleteItem="deleteBoard"
                />
                <button class="btn btn-success col-md-3 rounded-0 add" type="button" v-if="!is_board_adding"
                        v-on:click="is_board_adding = true"><h3>Add board</h3>
                </button>
                <div v-if="is_board_adding" class="col-md-3 p-0">
                    <div class="card">
                        <div class="card-header">
                            <label for="name">Enter board name</label>
                            <input autocomplete="off" id="name" v-model="new_board_name" placeholder="Enter board name" class="form-control" type="text">
                        </div>
                        <div class="card-body">
                            <textarea autocomplete="off" v-model="new_board_description" class="form-control"></textarea>
                        </div>
                        <div class="card-footer">
                            <button v-on:click="createBoard" class="btn btn-success rounded-0">Add</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import BoardListItem from "./board-list-item"

export default {
    name: "board-list",
    data() {
        return {
            is_board_adding: false,
            new_board_name: "",
            new_board_description: "",
            show_modal_window: false,
        };
    },
    methods: {
        createBoard() {
            this.$store.dispatch("addNewBoard", {name: this.new_board_name, description: this.new_board_description});
            this.new_board_name = "";
            this.new_board_description = "";
            this.is_board_adding = "";
        },
        deleteBoard(data){
            this.$store.dispatch("deleteFromBoardsList", data);
        },
    },
    computed: {
        boards_list() {
            return this.$store.getters.getBoardsList;
        },
    },
    mounted() {
        this.$store.dispatch("getBoardsList");
    },

    components: {BoardListItem},
}
</script>

<style scoped>
    .add{
        min-height: 20em;
    }
</style>
