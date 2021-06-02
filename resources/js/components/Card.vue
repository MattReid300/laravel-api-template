<template>
  <div class="card">
    <div class="card-body" style="padding: 0px">
      <button
        type="button"
        class="btn btn-light"
        data-toggle="modal"
        :data-target="`#modal-${id}`"
        style="height: 8rem; width: 100%"
      >
        <p>{{ title }}</p>
      </button>
      <div
        class="modal fade"
        :id="`modal-${id}`"
        tabindex="-1"
        role="dialog"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true"
      >
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">{{ title }}</h5>
              <button
                type="button"
                class="close"
                data-dismiss="modal"
                aria-label="Close"
              ></button>
            </div>
            <div class="modal-body">
              <p :contenteditable="isContentEditable" ref="body">{{ body }}</p>
              <button v-if="isContentEditable" @click="saveArticle">
                Save
              </button>
            </div>
            <div class="footer" style="text-align: right">
              <button
                type="button"
                class="btn btn-info"
                id="btn1"
                @click="editArticle"
              >
                Edit
              </button>
              <button
                type="button"
                class="btn btn-danger"
                id="btn2"
                @click="deleteArticle"
              >
                Delete
              </button>
              <button
                type="button"
                class="btn btn-secondary"
                id="btn3"
                data-dismiss="modal"
              >
                Close
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
    
<script>
// import { defineComponent } from '@vue/composition-api'
export default {
  data() {
    return {
      isContentEditable: false,
    };
  },
  props: {
    title: { type: String },
    body: { type: String },
    id: { type: Number }
  },
  methods: {
    deleteArticle() {
      axios({
        url: "http://127.0.0.1:8000/api/articles/" + this.id,
        method: "DELETE",
      }).then((response) => {
        if (response.status == 200) {
          console.log(response);
          this.$emit("arrayTruncated", this.id);
          $(`#modal-${this.id}`).modal("hide");
        } else {
          console.log(error);
        }
      });
    },
    editArticle() {
      this.isContentEditable = true;
    },
    saveArticle() {
      const newBody = this.$refs.body;
      let body = newBody.textContent;
      axios({
        url: "http://127.0.0.1:8000/api/articles/" + this.id,
        method: "PUT",
        data: {
          body,
        },
      }).then((response) => {
        if (response.status == 200) {
          console.log(response);
          this.$emit("arrayArtModified", this.id, body);
          $(`#modal-${this.id}`).modal("hide");
        } else {
          console.log(error);
        }
      });
    },
  },
};
</script>

<style scoped>
.card {
  margin: 30px;
  border-width: 0.5ch;
  border-color: rgb(0, 120, 0);
  width: 38rem;
}
[id^="btn"] {
  margin-right: 1px;
  margin-bottom: 2px;
  width: 80px;
}
</style>
