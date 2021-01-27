<template>
  <main-layout>
    <template #header>
      Мои программы
    </template>
    <div class="main__content__my-portfels-diagram" v-if="chartData">
      <Chart
        :id="id"
        :option="option"
      />
    </div>
    <ul class="main__content__agent-portfels-nav">
      <li class="main__content__portfels-nav__item"
          :class="showType == 1 ? 'active' : ''">
        <a href="#"
           @click.prevent="showType = 1"
           class="main__content__portfels-nav__link">
          Накопительные
        </a>
      </li>
      <li class="main__content__portfels-nav__item"
          :class="showType == 2 ? 'active' : ''">
        <a href="#"
           @click.prevent="showType = 2"
           class="main__content__portfels-nav__link">
          Разовые
        </a>
      </li>
    </ul>
    <div class="main__content__agent-portfels-flex"
      v-show="showType == 1"
    >
      <DealCard v-for="deal in cumulatives"
                :deal="deal"
                :key="deal.id"/>
    </div>
    <div class="main__content__agent-portfels-flex"
      v-show="showType == 2"
    >
      <DealCard v-for="deal in oneTimes"
                :deal="deal"
                :key="deal.id"/>
    </div>
    <div class="main__content__agent-empty-courses" v-if="!deals || deals.length == 0">
      <p class="main__content__empty-courses__text">У вас пока нет договоров</p>
      <inertia-link :href="route('briefcases.index')" class="main__content__empty-courses__button">
        Перейти к портфелям
      </inertia-link>
    </div>
  </main-layout>
</template>

<script>
  import MainLayout from '@/Layouts/MainLayout'
  import DealCard from '@/Shared/DealCard';
  import Chart from '@/Shared/PieChart'

  export default {
    name: 'Deals',
    props: {
      deals: Array,
      chartData: {
        type: Array,
        default: null
      }
    },
    data() {
      return {
        showType: 1,
        id:"test",
        option: {
          chart: {
            type: "pie", //pie chart
            options3d: {
              enabled: true, //Use 3d function
              alpha: 60, //inclination angle along the y-axis
              beta: 0,
            }
          },
          title: {
            text: "Диаграмма общих портфелей" //The title text of the chart
          },
          subtitle: {
            text: "" //Subtitle text
          },
          plotOptions: {
            pie: {
              allowPointSelect: true, //Can each sector be selected
              cursor: "pointer", //mouse pointer
              depth: 35, //The thickness of the pie chart
              dataLabels: {
                enabled: true, //Whether to display the linear tip of the pie chart
                // format: '{point.name}'
              }
            }
          },
          series: [
            {
              data: this.chartData
            }
          ]
        }
      }
    },
    components: {
      MainLayout,
      DealCard,
      Chart
    },
    computed: {
      cumulatives() {
        return this.deals.filter(d => d.briefcase.type_id == 1);
      },
      oneTimes() {
        return this.deals.filter(d => d.briefcase.type_id == 2);
      }
    }
  }
</script>
