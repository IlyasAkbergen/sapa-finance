export default {
  methods: {
    getUser() {
      return this.$page.user
    },
    hasLevel(level) {
      return this.referralLevel === level || true;
    },
  },

  computed: {
    username() {
      return this.getUser().name
    },

    referralLevel() {
      console.log(this.getUser());
      return "todo here must be level";
    },

    avatarPath() {
      return this.getUser().profile_photo_path;
    }
  },
}
