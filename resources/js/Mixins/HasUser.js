export default {
  methods: {
    getUser() {
      return this.$page.user
    },
    hasLevel(level) {
      return this.referralLevel != null
        && this.referralLevel.slug === level
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
    }
  },
}
