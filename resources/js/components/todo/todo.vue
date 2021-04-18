<template>
    <div class="row form-group border-bottom">
        <div class="col-md-9">
            {{ content }}
        </div>
        <div class="col-md-2">
            <button @click="deleteComponent" class="btn btn-danger rounded-0">del</button>
        </div>
    </div>
</template>

<script>
export default {
    name: "todo",
    props: ["id", "content", "todo_board_id", "array_key"],
    methods: {
        deleteComponent(){
            this.$store.dispatch("deleteTodo", {id: this.id, array_key: this.array_key});
        },
    },
}
</script>

<style scoped>
.card {
    min-height: 20em;
    margin-bottom: 0;
}
</style>
