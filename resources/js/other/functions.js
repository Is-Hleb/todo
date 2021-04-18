export default {
    get_csrf_token() {
        return document.getElementsByName("csrf_token")[0].getAttribute("content");
    },
    alert(text) {
        return `<div class="alert alert-warning alert-dismissible fade show" role="alert">
      <strong>${text}</strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>`
    },
}
