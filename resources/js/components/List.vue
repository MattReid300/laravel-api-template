<template>
  <div class="container">
    <button
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
            <input
              type="text"
              id="title"
              v-model="article.title"
              style="width: 25rem"
            />
            <br />
            <br />
            <label>Body:</label>
            <br />
            <textarea
              rows="5"
              cols="20"
              id="body"
              v-model="article.body"
              style="width: 25rem; height: 10rem"
            />
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-primary"
              data-dismiss="modal"
              @click="createArticle"
            >
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
          class="card"
        ></Card>
      </div>
    </div>
  </div>
</template>

<script>
import Card from "./Card.vue";
// import articles from 'C:\Users\Despacho\laravel-api-template\routes\api.php'
export default {
  components: { Card },
  data() {
    return {
      articles: [],
      article: {
        title: "",
        body: "",
      },
    };
  },
  mounted() {
    axios({
      url: "http://127.0.0.1:8000/api/articles",
      method: "GET",
    }).then((response) => {
      this.articles = response.data.sort((a, b) => b.id - a.id, { id: 0 });
    });
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
        url: "http://127.0.0.1:8000/api/articles/",
        method: "POST",
        data: {
          ...this.article,
        },
      })
        .then((response) => {
          if (response.status == 201) {
            console.log(response);
            let newArt = response.data;
            this.articles.unshift(newArt);
            this.article.title = "";
            this.article.body = "";
            alert("Your even has been registered!");
          }
        })
        .catch((error) => console.error(error));
    },
  },
};
</script>

<style scoped>
.card {
  transition: box-shadow 0.3s;
  border-radius: 10px;
  border: 3px solid #ccc;
}
.card:hover {
  box-shadow: 0 0 11px rgba(33, 33, 33, 0.2);
}
</style>