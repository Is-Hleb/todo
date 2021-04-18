
import BoardList from "../components/board/board-list"
import TodoMain from "../components/todo/todo-main"

export default {
    routes: [
        {path: '/', component: BoardList},
        {path: '/board/:id', name: "boardId", props: true, component: TodoMain}
    ],
}
