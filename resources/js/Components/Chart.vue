<script>
import VueApexCharts from 'vue-apexcharts'

export default {
    props:{
        p:Array,
        count:Array,
        eventCount:Array,
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
                name: 'projects',
                data: this.count,
            },
                {
                    name: 'events',
                    data: this.eventCount
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
