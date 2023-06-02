<script setup>
import {Head} from '@inertiajs/vue3';
import Chart from "@/Components/Chart.vue";
import moment from "moment";
import {Link} from "@inertiajs/vue3";
import CreateAccount from "@/Components/CreateAccount.vue";
import {computed, defineComponent} from "vue";
let props = defineProps({
    projects: Object,
    events: Array,
    p:Array,
    count:Array,
    totalEvents: Number,
    totalProjects: Number,
})
defineComponent({
    layout:AuthenticatedLayout
})
let dates = props.events.data.map(event => event.dateFrom);
let months = [
    'January', 'February', 'March', 'April', 'May',
    'June', 'July', 'August', 'September',
    'October', 'November', 'December'
];
let monthWords = dates.map(months => {
    return months.substring(5, 7);
}).map(item => {
    return months[parseInt(item) - 1]
});
// console.log(monthWords);
let uniqueMonths = [...new Set(monthWords)]; // Use Set to filter out duplicates
uniqueMonths.forEach(month => {
    // console.log(month); // Print each unique month only once
});
// Rest of your component's logic goes here

function getRemainingDays(dateFrom, dateTo) {
    const start = moment(dateFrom);
    const end = moment(dateTo);
    const duration = moment.duration(end.diff(start));

    const days = duration.asDays();

    return Math.ceil(days);

}
const currentDate = new Date();
const formattedDate = currentDate;
</script>
<script>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

export default {
    layout:AuthenticatedLayout
}
</script>
<template>
<!--    <AuthenticatedLayout>-->
        <Head title="Dashboard"/>


        <div class="row">
            <div class="col-xl-3 col-sm-6 col-12 d-flex">
                <div class="card bg-comman w-100">
                    <div class="card-body">
                        <div class="db-widgets d-flex justify-content-between align-items-center">
                            <div class="db-info">
                                <h6>Total Projects</h6>
                                <h3>{{ totalProjects }}</h3>
                            </div>
                            <div class="db-icon">
                                <img src="assets/img/icons/teacher-icon-01.svg" alt="Dashboard Icon">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12 d-flex">
                <div class="card bg-comman w-100">
                    <div class="card-body">
                        <div class="db-widgets d-flex justify-content-between align-items-center">
                            <div class="db-info">
                                <h6>Total Events</h6>
                                <h3>{{ totalEvents }}</h3>
                            </div>
                            <div class="db-icon">
                                <img src="assets/img/icons/teacher-icon-03.svg" alt="Dashboard Icon">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<!--<CreateAccount />-->
        <div class="row">
            <div class="col-12 col-lg-12 col-xl-8">

                <div class="row">
                    <div class="col-12 col-lg-12 col-xl-12 d-flex">
                        <div class="card flex-fill comman-shadow">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <h5 class="card-title">Projects Activity</h5>
                                    </div>
                                    <div class="col-6">
                                        <ul class="chart-list-out">
                                            <li><span class="circle-blue"></span>Teacher</li>
                                            <li><span class="circle-green"></span>Students</li>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <!--                                <div id="school-area"></div>-->
                                <Chart :p="$page.props.p" :count="$page.props.count"/>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-12 col-xl-12 d-flex">
                        <div class="card flex-fill comman-shadow">
                            <div class="card-header d-flex align-items-center">
                                <h5 class="card-title">Projects History</h5>

                            </div>
                            <div class="card-body">
                                <v-alert v-if="projects.data.length < 1"
                                         type="info"
                                         title="No data founded"
                                         text="There are is no data"
                                         variant="tonal"
                                ></v-alert>
                                <div class="teaching-card" v-else v-for="project in projects.data"
                                     :key="project.id">
                                    <ul class="steps-history">
                                        <!--                                        <li>Sep22</li>-->
                                        <!--                                        <li>Sep23</li>-->
                                        <!--                                        <li>Sep24</li>-->
                                    </ul>
                                    <ul class="activity-feed">
                                        <li class="feed-item d-flex align-items-center">
                                            <div class="dolor-activity">
                                                <span class="feed-text1"><a>{{ project.title }}</a></span>
                                                <ul class="teacher-date-list">
                                                    <li><i class="fas fa-calendar-alt me-2"></i>{{
                                                            moment(project.created_at).format('YYYY-MM-DD')
                                                        }}
                                                    </li>
                                                    <li>|</li>
                                                    <a href="">
                                                        <li><i class="feather-github me-2"></i>Github
                                                        </li>
                                                    </a>
                                                    <li><i class="feather-eye me-2"></i>Demo
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="activity-btns ms-auto">
                                                <button type="submit" class="btn btn-info">In Progress</button>
                                            </div>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-12 col-xl-4 d-flex" v-if="events.data.length > 0">
                <div class="card flex-fill comman-shadow">
                    <div class="card-body">
                        <div class="calendar-info1">
                            <div class="up-come-header">
                                <h2>Upcoming Events</h2>
                                <span><Link :href="route('calendar.overview')"><i
                                    class="feather-plus"></i></Link></span>
                            </div>
                            <div v-for="month in uniqueMonths" :key="month.id">
                                <div class="upcome-event-date">
                                    <h3>{{ month }}</h3>
                                    <!--                                    <span><i class="fas fa-ellipsis-h"></i></span>-->
                                </div>
                                <div v-for="event in events.data"
                                     :key="event.id">

                                    <div class="calendar-details" v-if="month == moment(event.dateFrom).format('MMMM')">

                                        <p style="font-size: 10px" v-if="event.timeFrom !== null">{{ event.timeFrom }}
                                            {{ event.timeTo }}</p>
                                        <div class="calendar-box  normal-bg">
                                            <div class="calandar-event-name">
                                                <div class="event-square" :class="getRemainingDays(currentDay, event.dateTo) > 15 ? 'green' : getRemainingDays(currentDay, event.dateTo) < 7 ? 'red' : 'yellow'">
                                                    <strong>{{ getRemainingDays(formattedDate, event.dateTo) }}</strong>
                                                </div>
                                                <h4>{{ event.title }}</h4>
                                                <h5>{{ event.title }}</h5>
                                            </div>
                                            <span>{{ event.dateFrom }} - {{ event.dateTo }}</span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <v-alert v-else
                     type="info"
                     variant="tonal"
            >
                <v-alert-title style="justify-content: center;display: flex">There is no Events</v-alert-title>
            </v-alert>
        </div>
<!--    </AuthenticatedLayout>-->
</template>
