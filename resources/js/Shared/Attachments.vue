<template>
  <div>
    <div class="course-docs-list"
       v-for="item in attachments"
       :key="item.id">
      <div class="d-flex">
        <img src="../../img/uploaded-file.png">

        <span id="course-doc-name" class="mt-2">
          {{ item.name | truncate(30) }}
        </span>
      </div>

      <a href="#" class="mt-1">
        <img src="../../img/remove-uploaded-file.png"
             @click="() => destroy(item.id)">
      </a>
    </div>

    <label class="profile-form__label label-doc"
           @drop="selectNewFile"
           @click="selectNewFile">
      <img src="../../img/add_file.svg">
      <span>Приложите документ</span>
    </label>
    <input type="file"
           ref="file"
           @change="upload"
           class="hidden">
  </div>
</template>

<script>
export default {
    name: "Attachments",
    props: {
        modelType: String,
        modelId: Number,
        uuid: String
    },
    data() {
        return {
            attachments: [],
            attachmentsForm: this.$inertia.form({
              model_type: this.modelType,
              model_id: this.modelId,
              uuid: this.uuid,
              file: null
            })
        }
    },
    methods: {
        load() {
            axios.post('/attachments/list', this.attachmentsForm)
                .then((r) => this.attachments = r.data.data)
        },
        selectNewFile() {
          this.$refs.file.click();
        },
        upload() {
            let formData = new FormData();
            formData.append('model_type', this.modelType)
            formData.append('model_id', this.modelId)
            formData.append('uuid', this.uuid)
            if (this.$refs.file) {
              formData.append('file', this.$refs.file.files[0]);
            }
            axios.post('/attachments', formData)
              .then((r) => this.load())
        },
        destroy(id) {
            axios.delete('/attachments/' + id)
              .then(() => this.load())
        }
    },
    created() {
      this.load()
    }
}
</script>

