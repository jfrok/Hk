<script>
import VueApexCharts from 'vue-apexcharts'

export default {
    props:{
        p:Array,
        count:Array,
    },
    data: function() {
        return {
            options: {
                chart: {
                    id: 'vuechart-example'
                },
                xaxis: {
                    categories: this.p
                }
            },
            series: [{
                name: 'series-1',
                data: this.count
            }]
        }
    }
}
</script>
<template>
    <div>
        <apexchart width="100%" type="line" :options="options" :series="series"></apexchart>
    </div>
</template>
