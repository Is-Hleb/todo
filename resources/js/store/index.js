import axios from "axios"
import Vuex from "vuex"
import Vue from "vue"
import Fun from "../other/functions";

Vue.use(Vuex)

const state = {
    authUser: {},
    boards_list: [],
    todo_boards_list: [],
    todos_list: [],
    errors: {
        on_board_creation: [],
    },
};

const getters = {
    getAuthUser: state => {
        return state.authUser;
    },
    getTodosList: state => {
        return state.todos_list;
    },
    getBoardsList: state => {
        return state.boards_list;
    },
    getTodoBoardsList: state => {
        return state.todo_boards_list;
    },
};

const actions = {
    getAuthUser({commit}) {
        axios.get("api/get/user/auth").then((response) => {
            commit("SET_AUTH_USER", response.data);
        })
    },
    getBoardsList({commit}) {
        axios.get("api/get/boards-list").then(response => {
            commit("SET_BOARDS_LIST", response.data);
        });
    },
    getAllTodoBoards({commit}, id) {
        axios.post("api/post/get-todo-boards", {
            _token: Fun.get_csrf_token(),
            id: id,
        }).then(response => {
            commit("SET_TODO_BOARDS_LIST", response.data);
        });
    },
    getAllTodos({commit}, todo_board_id) {
        axios.post("api/post/get-todos", {
            _token: Fun.get_csrf_token(),
            todo_board_id: todo_board_id,
        }).then(response => {
            console.log(response.data);
            commit("SET_TODOS_LIST", response.data);
        });
    },

    addNewTodo({commit}, todo) {
        axios.post("api/post/create-todo", {
            _token: Fun.get_csrf_token(),
            todo_board_id: todo.todo_board_id,
            content: todo.content
        }).then(response => {
            if(parseInt(response.data))
                commit("ADD_TO_TODOS_LIST", {
                    content: todo.content,
                    id: response.data,
                    todo_board_id: todo.todo_board_id
                });
        });
    },
    addNewBoard({commit}, board) {
        axios.post("api/post/create-board", {
            _token: Fun.get_csrf_token(),
            name: board.name,
            description: board.description,
        }).then((response) => {
            if (parseInt(response.data))
            {
                board.id = response.data;
                commit("ADD_TO_BOARDS_LIST", board);
            }

        });
    },
    addNewTodoBoard({commit}, board) {
        axios.post("api/post/create-todo-board", {
            _token: Fun.get_csrf_token(),
            name: board.name,
            color: board.color,
            board_id: board.board_id,
        }).then(response => {
            commit("ADD_TO_TODO_BOARDS_LIST", {
                color: board.color,
                name: board.name,
                id: response.data
            });
        });
    },
    clearAllTodoBoards({commit}, data) {
        commit("CLEAR_TODO_BOARS_LIST");
    },

    deleteTodo({commit}, data) {
        axios.get(`api/get/delete-todo/${data.id}`).then(r => {
            commit("DELETE_TODO", data.array_key);
        });
    },
    deleteFromBoardsList({commit}, data) {
        axios.get(`api/get/board-delete/${data.id}`).then(r => {
            commit("DELETE_BOARD_FROM_LIST", data.key);
        });
    },
    deleteFromTodoBoardsList({commit}, data) {
        axios.get(`api/get/delete-todo-board/${data.id}`).then(r => {
            commit("DELETE_TODO_BOARD_FROM_TODO_BOARDS_LIST", data.key);
        });
    }
};

const mutations = {
    SET_AUTH_USER(state, authUser) {
        state.authUser = authUser;
    },
    SET_BOARD_CREATION_ERRORS(state, errors) {
        state.errors.on_board_creation = errors;
    },
    SET_TODO_BOARDS_LIST(state, data) {
        state.todo_boards_list = data;
    },
    SET_BOARDS_LIST(state, list) {
        state.boards_list = list;
    },
    SET_TODOS_LIST(state, list) {
        state.todos_list = list;
    },

    ADD_TO_TODOS_LIST(state, todo) {
        state.todos_list.push(todo);
    },
    ADD_TO_BOARDS_LIST(state, board) {
        state.boards_list.push(board);
    },
    ADD_TO_TODO_BOARDS_LIST(state, board) {
        state.todo_boards_list.push(board);
    },

    DELETE_TODO(state, key) {
        state.todos_list.splice(key, 1);
    },
    CLEAR_TODO_BOARS_LIST(state) {
        state.todo_boards_list = [];
    },
    DELETE_BOARD_FROM_LIST(state, key) {
        state.boards_list.splice(key, 1);
    },
    DELETE_TODO_BOARD_FROM_TODO_BOARDS_LIST(state, key) {
        state.todo_boards_list.splice(key, 1);
    },
};

export default new Vuex.Store({
    state,
    getters,
    actions,
    mutations
})
