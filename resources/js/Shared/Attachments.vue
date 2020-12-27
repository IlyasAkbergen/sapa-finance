<template>
  <div v-if="!onlyShow">
    <div class="course-docs-list"
       v-for="item in list"
       :key="item.id">
      <div class="d-flex">
        <img src="../../img/uploaded-file.png">

        <span id="course-doc-name" class="mt-2">
          {{ item.name | truncate(20) }}
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
      <img v-if="!isSupport" src="../../img/add_file.svg">
      <i v-else class="fas fa-plus" aria-hidden="true"></i>
      <span>{{title}}</span>
    </label>
    <input type="file"
           ref="file"
           @change="upload"
           class="hidden">
  </div>
  <div v-else class="main__content__lesson-card__materials">
    <a v-for="item in list"
       :href="item.path"
       :key="item.id"
       target="_blank"
       class="main__content__lesson-card__materials__pdf">
      {{ item.name | truncate(5) }}
    </a>
  </div>
</template>

<script>
export default {
    name: "Attachments",
    props: {
        modelType: String,
        modelId: {
          type: Number,
          default: null
        },
        uuid: {
          type: String,
          default: null
        },
        slug: {
          type: String,
          default: null
        },
        onlyShow: {
        	type: Boolean,
        	default: false
        },
        title: {
          type: String,
          default: 'Приложите документ'
        },
        isSupport: {
          type: Boolean,
          default: false
        },
    },
    data() {
        return {
            attachments: [],
        }
    },
    computed: {
      list() {
        return this.attachments
      }
    },
    methods: {
        load() {
          if (this.modelId || this.uuid) {
            axios.post('/attachments/list', {
              'model_id': this.modelId,
              'model_type': this.modelType,
              'uuid': this.uuid,
              'slug': this.slug
            }).then((r) => {
              this.attachments = r.data.data
            })
        	}
        },
        selectNewFile() {
          this.$refs.file.click();
        },
        upload() {
            let formData = new FormData();
            formData.append('model_type', this.modelType)

            if (this.modelId) {
              formData.append('model_id', this.modelId)
            }

            if (this.uuid) {
              formData.append('uuid', this.uuid)
            }

            if (this.slug) {
              formData.append('slug', this.slug)
            }

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

