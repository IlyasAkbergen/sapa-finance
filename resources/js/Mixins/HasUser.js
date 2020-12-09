export default {
  methods: {
    getUser() {
      return this.$page.user
    },
    hasSomeLevel(levels) {
      return this.referralLevel != null
        && levels.some(level => this.referralLevel.slug.toLowerCase() === level.toLowerCase())
    }
  },

  computed: {
    username() {
      return this.getUser().name
    },

    referralLevel() {
      console.log(this.getUser().referral_level);
      return !!this.getUser().referral_level
        ? this.getUser().referral_level
        : null;
    },

    balance() {
      return !!this.getUser().balance
        ? this.getUser().balance
        : null;
    },

    avatarPath() {
      return this.getUser().profile_photo_path;
    },

    referrer() {
      return !!this.getUser().referrer
        ? this.getUser().referrer
        : null;
    },

    isAdmin() {
      return !!this.getUser() && this.getUser().role_id === 1
    }
  },
}
