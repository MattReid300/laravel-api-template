<template>
  <div class="container">
    <button
      @click="createArticle"
      style="margin-left: 190px; background-color: lightgreen"
      data-toggle="modal"
      data-target="#exampleModal2"
    >
      Create new
    </button>
    <div
      class="modal fade"
      id="exampleModal2"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
              Create new Article
            </h5>
          </div>
          <div class="modal-body">
              <label>Title:</label>
              <br />
              <input type="text" id="title" style="width: 25rem">
              <br />
              <br />
              <label>Body:</label>
              <br />
              <input type="text" id="body" style="width: 25rem; height: 10rem">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">
              Submit
            </button>
            <button
              type="button"
              class="btn btn-secondary"
              data-dismiss="modal"
            >
              Cancel
            </button>
          </div>
        </div>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-md-8">
        <Card
          v-for="article in articles"
          :key="article.id"
          v-bind="article"
          @arrayArtModified="editArrayItem"
          @arrayTruncated="removeArrayItem"
        ></Card>
      </div>
    </div>
  </div>
</template>

<script>
import Card from "./Card.vue";
// import articles from 'C:\Users\Despacho\laravel-api-template\routes\api.php'
export default {
  data() {
    return {
      articles: [],
    };
  },
  components: { Card },
  mounted() {
    axios({
      url: "http://127.0.0.1:8000/api/articles",
      method: "GET",
    }).then((response) => (this.articles = response.data));
  },
  methods: {
    removeArrayItem(id) {
      const newArr = this.articles.filter((item) => item.id != id);
      this.articles = newArr;
    },
    editArrayItem(id, body) {
      const index1 = this.articles.findIndex((element) => element.id == id);
      this.articles[index1].body = body;
    },
    createArticle() {
      axios({
        url: "http://127.0.0.1:8000/api/articles/" + this.id,
        method: "POST",
      }).then((response) => {
        if (response.status == 200) {
          console.log(response);
        } else {
          console.log(error);
        }
      });
    },
  },
};
</script>
