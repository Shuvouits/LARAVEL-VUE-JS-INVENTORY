<template>
  <div id="chart">
    <apexchart
      type="bar"
      height="350"
      :options="chartOptions"
      :series="series"
    ></apexchart>
  </div>
</template>

<script>
import VueApexCharts from 'vue3-apexcharts';

export default {
  components: {
    apexchart: VueApexCharts,
  },

  props: {
    month_wise_sale: {
      type: Array,
      required: true,
    },
    month_wise_purchase: {
      type: Array,
      required: true,
    },
    month_wise_expense: {
      type: Array,
      required: true,
    },
  },

  data() {
    return {
      series: [],
      chartOptions: {
        chart: {
          type: "bar",
          height: 350,
        },
        plotOptions: {
          bar: {
            horizontal: false,
            columnWidth: "95%",
            endingShape: "rounded",
          },
        },
        dataLabels: {
          enabled: false,
        },
        stroke: {
          show: true,
          width: 1,
          colors: ["transparent"],
        },
        xaxis: {
          categories: [
            "Jan",
            "Feb",
            "Mar",
            "Apr",
            "May",
            "Jun",
            "Jul",
            "Aug",
            "Sep",
            "Oct",
            "Nov",
            "Dec"
          ],
        },
        yaxis: {
          title: {
            text: "$ (taka)",
          },
        },
        fill: {
          opacity: 1,
        },
        tooltip: {
          y: {
            formatter: function (val) {
              return "$ " + val + " taka";
            },
          },
        },
      },
    };
  },

  watch: {
    // Watch for changes in the props and update the series accordingly
    month_wise_sale: 'updateSeries',
    month_wise_purchase: 'updateSeries',
    month_wise_expense: 'updateSeries',
  },

  created() {
    // Initialize the series data here with the prop value
    this.updateSeries();
  },

  methods: {
    updateSeries() {
      this.series = [
        {
          name: "Sale",
          data: this.month_wise_sale,
        },
        {
          name: "Purchase",
          data: this.month_wise_purchase,
        },
        {
          name: "Expense",
          data: this.month_wise_expense,
        },
      ];
    },
  },
};
</script>

<style scoped>
#chart {
  margin: auto;
  width: 80%;
}
</style>
