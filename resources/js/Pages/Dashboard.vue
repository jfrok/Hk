<script setup>
import {Head, router, useForm, usePage} from '@inertiajs/vue3';
import Chart from "@/Components/Chart.vue";
import {Link} from "@inertiajs/vue3";
import {onMounted, ref} from 'vue'
import {computed, defineComponent, onActivated, reactive, watch} from "vue";
import moment from 'moment';

   function arabicDay(dateFrom) {
        const englishDay = moment(dateFrom).format('dddd');
        const arabicDays = {
            Sunday: 'الأحد',
            Monday: 'الاثنين',
            Tuesday: 'الثلاثاء',
            Wednesday: 'الأربعاء',
            Thursday: 'الخميس',
            Friday: 'الجمعة',
            Saturday: 'السبت',
        };
        return arabicDays[englishDay] || '';
    }


const currentDate = new Date();
const formattedDate = currentDate;

function goToCalendar(dateFrom) {
    this.router.visit(route('calendar.overview', {date: dateFrom}));
}


let props = defineProps({
    projects: Object,
    events: Array,
    p: Array,
    eventCount: Array,
    count: Array,
    counterTrueOrFalse: Number,
    countNextEvent: Number,
    totalEvents: Number,
    totalProjects: Number,
})
function getRemainingDays(dateFrom, dateTo) {
    const start = moment(dateFrom);
    const end = moment(dateTo);
    const duration = moment.duration(end.diff(start));
    const days = duration.asDays();
    return Math.ceil(days);
}
// const selectedFilter = ref('');

let filteringEvents = reactive({
    past:false,
    closest:false,
    upcoming:false
})
let months = [
    'January', 'February', 'March', 'April', 'May',
    'June', 'July', 'August', 'September',
    'October', 'November', 'December'
];

let uniqueYears = []; // Initialize uniqueYears array
let monthsByYear = {}; // Initialize months object with years as keys

const updateMonthsByYear = (events) => {
    events.forEach((event) => {
        const year = event.dateFrom.substring(0, 4);
        const month = event.dateFrom.substring(5, 7);

        if (!monthsByYear.hasOwnProperty(year)) {
            monthsByYear[year] = [];
        }

        if (!monthsByYear[year].includes(month)) {
            monthsByYear[year].push(month);
        }
    });

    uniqueYears = Object.keys(monthsByYear); // Update uniqueYears array
};

watch (filteringEvents, (value) => {

    router.get(route('dashboard'), filteringEvents, {

        preserveScroll: true,
        preserveState: true,
    }

    );
    if (filteringEvents.past === true) {
         uniqueYears = [];
         monthsByYear = {};
        filteringEvents.upcoming = false;
        filteringEvents.closest = false;
    } else if (filteringEvents.upcoming === true) {
        uniqueYears = [];
        monthsByYear = {};
        filteringEvents.past = false;
        filteringEvents.closest = false;
    } else if (filteringEvents.closest === true) {
        uniqueYears = [];
        monthsByYear = {};
        filteringEvents.past = false;
        filteringEvents.upcoming = false;
    }else {
        uniqueYears = [];
        monthsByYear = {};
    }
});

// Call updateMonthsByYear initially with the events data

updateMonthsByYear(props.events);


watch(() => props.events, (newEvents) => {
    // console.log(newEvents.data)
    updateMonthsByYear(newEvents);
});

let showData = reactive({
    showMore:10
});
function showMore (){
    showData.showMore += 2;
    // console.log(showData.showMore);
    router.get(route('dashboard'),showData,{
     preserveScroll:true, preserveState:true,
    }, )

    // console.log(showData)
}
// styling function

</script>
<script>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {router} from "@inertiajs/vue3";

export default {
    layout: AuthenticatedLayout,
    data () {
        return {
            dialogm1: '',
            dialog: false,
            // showMore:2
            // showEvents: false,
        }

    },
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
                                    <h5 class="card-title">Activity's</h5>
                                </div>
                                <div class="col-6">
                                    <ul class="chart-list-out">
                                        <!--                                            <li><span class="circle-blue"></span>Teacher</li>-->
                                        <!--                                            <li><span class="circle-green"></span>Students</li>-->

                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <!--                                <div id="school-area"></div>-->
                            <Chart :p="$page.props.p" :count="$page.props.count" :eventCount="$page.props.eventCount"/>
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

        <div class="col-12 col-lg-12 col-xl-4 d-flex" >
            <div class="card flex-fill comman-shadow">
                <div class="card-body">
                    <div class="calendar-info1">
                        <div class="up-come-header">
                            <h2>{{usePage().props.auth.user.lang == 'arabic'? 'المواعيد القادمة' : 'Upcoming Events'}}</h2>
                            <span><Link :href="route('calendar.overview')"><i
                                class="feather-plus"></i></Link></span>
                        </div>
                        <div class="up-come-header" style="position: relative;float: right;margin-top: 3px;">
                            <span @click="dialog = true" class="feather-filter"></span>
<!--                            <FilterDialog />-->
                        </div>
                        <v-row justify="center">
                            <v-dialog
                                v-model="dialog"
                                scrollable
                                width="auto"
                            >
                                <v-card>
                                    <v-card-title>Select a Filter</v-card-title>
                                    <v-divider></v-divider>
                                    <v-card-text style="height: auto;">
<!--                                                                    <input type="checkbox" class="mt-2" id="filter" v-model="filteringEvents.past">-->
                                        <v-checkbox label="upcoming" v-model="filteringEvents.upcoming"></v-checkbox>
                                        <v-checkbox label="week" v-model="filteringEvents.closest"></v-checkbox>
                                        <v-checkbox label="earlier" v-model="filteringEvents.past"></v-checkbox>
<!--                                        <v-radio-group v-model="selectedFilter">-->
<!--                                            <v-radio label="Upcoming" value="upcoming"></v-radio>-->
<!--                                            <v-radio label="Week" value="closest"></v-radio>-->
<!--                                            <v-radio label="Earlier" value="past"></v-radio>-->
<!--                                        </v-radio-group>-->
                                    </v-card-text>
                                    <v-divider></v-divider>
                                    <v-card-actions>
                                        <v-btn
                                            color="blue-darken-1"
                                            variant="text"
                                            @click="dialog = false"
                                        >
                                            Close
                                        </v-btn>
                                    </v-card-actions>
                                </v-card>
                            </v-dialog>
                        </v-row>
<!--                        <div v-if="showEvents" id="events-wrapper">-->
                            <div id="events-wrapper" v-for="year in uniqueYears" :key="year" >

                                <div class="upcome-event-date" style="display: flex;justify-content: center;margin-top: 70px">
                                    <h3>{{year}}</h3>
                                </div>
                                <div v-if="events.length > 0">

                                    <div v-for="month in monthsByYear[year]" :key="month" style="margin-top: 55px">
                                        <div class="upcome-event-date">
                                            <h3>{{ moment(month).format('MMMM') }}</h3>
                                        </div>

                                        <div v-for="event in events"
                                             :key="event.id">
                                            <div class="calendar-details" v-if="month == moment(event.dateFrom).format('MM') && year == moment(event.dateFrom).format('YYYY')">
                                                <p style="font-size: 10px" v-if="event.timeFrom !== null">{{ event.timeFrom }}
                                                    {{ event.timeTo }}</p>
                                                <div class="calendar-box  normal-bg">
                                                    <div class="calandar-event-name">
                                                        <div class="event-square"
                                                             :class="{
                                        'green': getRemainingDays(formattedDate, event.dateTo ?? event.dateFrom) > 15,
                                        'red': getRemainingDays(formattedDate, event.dateTo ?? event.dateFrom) < 7,
                                        'yellow': getRemainingDays(formattedDate, event.dateTo ?? event.dateFrom) >= 7 && getRemainingDays(formattedDate, event.dateTo ?? event.dateFrom) <= 15
                                    }"
                                                             :style="getRemainingDays(formattedDate, event.dateTo ?? event.dateFrom) < 0 ? 'background-color: gray; opacity: 80%' : ''">
                                                            {{getRemainingDays(formattedDate, event.dateTo ?? event.dateFrom) === 0 ? usePage().props.auth.user.lang === 'arabic' ? 'اليوم': 'Today' : getRemainingDays(formattedDate, event.dateTo ?? event.dateFrom)}}
                                                        </div>
                                                        <h4 style="cursor: pointer" @click="goToCalendar(event.dateFrom)">{{ event.title }}</h4>
                                                        <h5>{{ usePage().props.auth.user.lang == 'arabic' ? ' يصادف يوم '+arabicDay(event.dateFrom) : 'It falls on ' +moment(event.dateFrom).format('dddd') }}</h5>
                                                    </div>
                                                    <span>{{ event.dateFrom }} {{event.dateTo !== null ? 'to' : '' }} {{ event.dateTo }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <v-alert v-else style="margin-top: 70px"
                                         type="info"
                                         variant="tonal"
                                >
                                    <v-alert-title style="justify-content: center;display: flex">There is no events</v-alert-title>
                                </v-alert>
                            </div>
                        <div style="display: flex;justify-content: center;margin-top: 5px" v-if="events.length > 9 && !counterTrueOrFalse">
                        <a href="javascript:void(0)" @click="showMore" methods="post" id="showMoreBtn">{{usePage().props.auth.user.lang == 'arabic'? 'اظهار المزيد':'show more'}} <i class="feather-arrow-down"></i> ({{props.countNextEvent}})</a>
                        </div>
                </div>
                </div>
            </div>
        </div>

    </div>
<!--    </div>-->
    <!--    </AuthenticatedLayout>-->
</template>
