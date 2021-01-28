<template>
  <div :id="id"
       :option="option"/>
</template>
<script>
  import highcharts from "highcharts"

  export default {
    props: {
      id: {
        type: String
      },
      //option is the configuration data of the chart
      option: {
        type: Object
      }
    },
    mounted() {
      highcharts.chart(this.id, this.option)
    }
  }
</script>
<style scoped>
  .container {
    width:1000px;
    height:550px;
  }
</style>
