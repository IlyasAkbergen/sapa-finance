<template>
    <div class="main__content__sellings-wrapper__pagination">
        <a :href="prev_page_url"
           :disabled="!prev_page_url"
           class="main__content__sellings-wrapper__pagination__left">
            <svg width="16" height="16" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M8.47157 2.47157C8.73192 2.21122 8.73192 1.78911 8.47157 1.52876C8.21122 1.26841 7.78911 1.26841 7.52876 1.52876L1.52876 7.52876C1.26841 7.78911 1.26841 8.21122 1.52876 8.47157L7.52876 14.4716C7.78911 14.7319 8.21122 14.7319 8.47157 14.4716C8.73192 14.2112 8.73192 13.7891 8.47157 13.5288L3.60964 8.66683H14.0002C14.3684 8.66683 14.6668 8.36835 14.6668 8.00016C14.6668 7.63197 14.3684 7.3335 14.0002 7.3335H3.60964L8.47157 2.47157Z"></path>
            </svg>
        </a>
        <ul class="main__content__sellings-wrapper__pagination__nav">
            <li class="main__content__sellings-wrapper__pagination__nav-item main-item"
                v-for="link in linksWithoutArrows"
                :key="link.label"
                :class="link.active ? 'active' : ''">
                <a :href="link.url"
                   class="main__content__sellings-wrapper__pagination__nav-link">
                    {{ link.label }}
                </a>
            </li>
        </ul>
        <a :href="next_page_url"
           class="main__content__sellings-wrapper__pagination__right">
            <svg width="14" height="14" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M7.47157 0.528758C7.21122 0.268409 6.78911 0.268409 6.52876 0.528758C6.26841 0.789108 6.26841 1.21122 6.52876 1.47157L11.3907 6.3335H1.00016C0.631973 6.3335 0.333496 6.63197 0.333496 7.00016C0.333496 7.36835 0.631973 7.66683 1.00016 7.66683H11.3907L6.52876 12.5288C6.26841 12.7891 6.26841 13.2112 6.52876 13.4716C6.78911 13.7319 7.21122 13.7319 7.47157 13.4716L13.4716 7.47157C13.7319 7.21122 13.7319 6.78911 13.4716 6.52876L7.47157 0.528758Z"></path>
            </svg>
        </a>
    </div>
</template>

<script>
export default {
  name: "Pagination",
  props: {
    prev_page_url: String,
    next_page_url: String,
    last_page: Number,
    links: Array
  },
  computed: {
    linksWithoutArrows() {
      return this.links.slice(1, this.links.length - 1)
    }
  }
}
</script>