<template>
  <mcv-validation-errors v-if="errors" :validation-errors="errors" />
  <form @submit.prevent="onSubmit">
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Title</label>
      <input
        type="text"
        class="form-control"
        id="exampleInputEmail1"
        aria-describedby="emailHelp"
        v-model="name"
      />
    </div>
    <!--    <div class="mb-3">
      <label for="exampleInputPassword1" class="form-label">Password</label>
      <input type="text" class="form-control" id="exampleInputPassword1" />
    </div>-->
    <div class="mb-3">
      <label for="exampleFormControlTextarea1" class="form-label">Article</label>
      <textarea
        class="form-control"
        id="exampleFormControlTextarea1"
        rows="3"
        v-model="description"
      ></textarea>
    </div>
    <div class="mb-3">
      <label for="exampleInputPassword2" class="form-label">Tags</label>
      <input type="text" class="form-control" id="exampleInputPassword2" v-model="tagList" />
      <div class="form-text">Введите теги через запятую.</div>
    </div>

    <button type="submit" class="btn btn-primary" :disabled="isSubmitting">Publish Article</button>
  </form>
</template>

<script>
import McvValidationErrors from '@/components/ValidationErrors'

export default {
  name: 'McvArticleForm',
  components: {McvValidationErrors},
  emits: ['articleSubmit'],
  props: {
    initialValues: {
      type: Object,
      required: true,
    },
    errors: {
      type: Object,
      required: false,
    },
    isSubmitting: {
      type: Boolean,
      required: true,
    },
  },
  data() {
    return {
      name: this.initialValues.name,
      description: this.initialValues.description,
      // body: '',
      tagList: this.initialValues.tagList, //.split(',').map((item) => item.trim()),
    }
  },
  methods: {
    onSubmit() {
      const form = {
        name: this.name,
        description: this.description,
        tags: this.tagList,
      }
      if (form.tags.length > 1 && typeof form.tags === 'string') {
        form.tags = form.tags.split(',').map((item) => item.trim())
      } else {
        form.tags = []
      }
      this.$emit('articleSubmit', form)
    },
  },
}
</script>

<style scoped></style>
