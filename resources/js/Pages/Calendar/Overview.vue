<script>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {defineComponent, ref, watch, getCurrentInstance} from "vue";
import FullCalendar from "@fullcalendar/vue3";
import {router, useForm, usePage} from "@inertiajs/vue3";
import EventModal from "@/Components/EventModal.vue";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from "@fullcalendar/timegrid";
import interactionPlugin from "@fullcalendar/interaction";
import {eventDetails} from "@/Pages/Calendar/TestCalendar";
import {eventEditDetails} from "@/Pages/Calendar/EditCalendar";
import Modal from "@/Components/Modal.vue";
import moment from 'moment';

let allEvents = []
let dataToRender = []
let resize = ref([])

export default defineComponent({
    layout: AuthenticatedLayout,
    props: {
        events: Object,
    },
    computed: {},
    components: {
        FullCalendar,
        useForm,
        EventModal,
        Modal
    },
    setup(_, {emit}) {
        allEvents = ref([])
        const internalInstance = getCurrentInstance();

        const { page } = usePage();
        const calendarRef = ref(null);


        const handleEventDrop = (eventDropInfo) => {
            const eventId = eventDropInfo.event.id;
            const newStart = moment(eventDropInfo.event.start).format('YYYY-MM-DD')
            const newEnd = moment(eventDropInfo.event.end).format('YYYY-MM-DD')
                ? moment(eventDropInfo.event.end).format('YYYY-MM-DD')
                : null;
            // Send the data to the server using Inertia.js
            let dropForm = useForm({
               title:eventDropInfo.event.title,
                timeFrom:eventDropInfo.event.extendedProps.timeFrom,
                timeTo:eventDropInfo.event.extendedProps.timeTo,
                dateFrom: newStart,
                dateTo: newEnd,
            })
            dropForm
                .post(route('calendar.update', eventId),)
        };

        // Rest of the component setup...
        let form = useForm({
            title: '',
            timeFrom: '',
            timeTo: '',
            dateFrom: eventDetails.value[0],
            dateTo: eventDetails.value[1],
        })
        watch(() => eventDetails, ($eventDetails) => {
            // console.log( moment($eventDetails.value[$eventDetails.value.length - 1].start).format('HH:mm'))
            if (moment($eventDetails.value[$eventDetails.value.length - 1].start).format('HH:mm') !== '00:00') {
                form.timeFrom = moment($eventDetails.value[$eventDetails.value.length - 1].start).format('HH:mm')
                form.timeTo = moment($eventDetails.value[$eventDetails.value.length - 1].end).format('HH:mm')
            } else {
                form.timeFrom = ''
                form.timeTo = ''
            }
            if (moment($eventDetails.value[$eventDetails.value.length - 1].end).subtract(1,"days").format('YYYY-MM-DD') == moment($eventDetails.value[$eventDetails.value.length - 1].start).format('YYYY-MM-DD')) {
                form.dateFrom = moment($eventDetails.value[$eventDetails.value.length - 1].start).format('YYYY-MM-DD')
                form.dateTo = null;
            }else {
                form.dateFrom = moment($eventDetails.value[$eventDetails.value.length - 1].start).format('YYYY-MM-DD')
                form.dateTo = moment($eventDetails.value[$eventDetails.value.length - 1].end).subtract(1,"days").format('YYYY-MM-DD')
            }
        }, {deep: true})

        let editForm = useForm({
            eId: '',
            title: '',
            timeFrom: '',
            timeTo: '',
            dateFrom: eventEditDetails.value[0],
            dateTo: eventEditDetails.value[1],
        })
        /// watch the range of the evnt if its change update it to the data base
        watch(() => eventEditDetails, ($eventEditDetails) => {

            let lastArry = $eventEditDetails.value[$eventEditDetails.value.length - 1]
            console.log(lastArry.end)
            editForm.eId = lastArry.id
            editForm.title = lastArry.title
            editForm.timeFrom = lastArry.extendedProps.timeFrom
            editForm.timeTo = lastArry.extendedProps.timeTo
            editForm.dateFrom = lastArry.extendedProps.dateFrom
            editForm.dateTo = lastArry.extendedProps.dateTo
        }, {deep: true})
        // console.log(eventEditDetails.value[eventEditDetails.value.length - 1].end)
        watch(() => resize.value[resize.value.length - 1], ($endDate) => {
            editForm.eId = $endDate.event.id
            editForm.title = $endDate.event.title
            editForm.timeFrom = $endDate.event.extendedProps.timeFrom
            editForm.timeTo = $endDate.event.extendedProps.timeTo
            editForm.dateFrom = $endDate.event.extendedProps.dateFrom
            editForm.dateTo = moment($endDate.event.end).subtract(1,"days").format('YYYY-MM-DD')
            editForm.post(route('calendar.update', $endDate.event.id),{
                preserveScroll: true,
                onSuccess: () => {

                    // استدعاء دالة التحديث هنا بعد إضافة البيانات إلى قاعدة البيانات
                    updateCalendar();

                },
            })
        })
        function updateCalendar() {
            // Fetch updated events data from API or database
            $.get('/calendar/events', (data) => {
                dataToRender = data.events.map(x => {
                    x.start = x.timeFrom ? `${x.dateFrom}T${x.timeFrom}` : x.dateFrom;
                    x.end = x.timeTo ? `${x.dateTo}T${x.timeTo}` : x.dateTo;
                    if (!x.timeFrom) {
                        x.start =  `${x.dateFrom}`
                        x.end =  `${x.dateTo}T23:59:00`;
                    }
                    return x;
                });
                // Call success() to pass updated events data to the calendar
                internalInstance.proxy.calendarOptions.events = (info, success, fail) => {
                    success(dataToRender);
                }

                // Call updateEvents() on calendarApi object to update events on the calendar
                let calendarApi = this.$refs.calendar.getApi(); // Get calendarApi object
                calendarApi.refetchEvents(); // Update events on the calendar
            });
        }

        let submit = async () => {
            await form.post(route('calendar.add'), {
                onSuccess: () => {
                    $('#con-close-modal').modal('toggle')
                    form.reset('title')

                    // استدعاء دالة التحديث هنا بعد إضافة البيانات إلى قاعدة البيانات
                    updateCalendar();

                },
            });
        };

        let update = async () => {
            await editForm.post(route('calendar.update', editForm.data().eId), {
                preserveScroll: true,
                // onStart: () => Spinner.content({content:"Saving Settings..."}),

                onSuccess: () => {
                    // استدعاء دالة التحديث هنا بعد إضافة البيانات إلى قاعدة البيانات
                    $('#editEventModal').modal('toggle')

                    updateCalendar();
                },
            });

        };
        let remove = async () => {
            await editForm.post(route('calendar.remove', editForm.data().eId), {
                preserveScroll: true,
                onSuccess: () => {
                    // استدعاء دالة التحديث هنا بعد إضافة البيانات إلى قاعدة البيانات
                    updateCalendar();

                    $('#editEventModal').modal('close')

                },
            });
        }
        return {form, submit, update, remove, updateCalendar, editForm,handleEventDrop}
    },
    data() {


        // function testCalendar() {
        return {
            step: 1,
            dialog: false,
            calendarOptions: {

                plugins: [
                    dayGridPlugin,
                    timeGridPlugin,
                    interactionPlugin // needed for dateClick
                ],
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                //  locale: esLocale,
                initialView: 'dayGridMonth',
                // initialEvents: INITIAL_EVENTS, // alternatively, use the `events` setting to fetch from a feed
                editable: true,
                selectable: true,
                selectMirror: true,
                dayMaxEvents: true,
                weekends: true,
                select: this.handleDateSelect,
                eventClick: this.handleEventClick,
                eventDrop: this.handleEventDrop,
                eventResize: this.handleEventResize,
                // eventsSet: this.handleEvents
                /* you can update a remote database when these fire:
                eventAdd:
                eventChange:
                eventRemove:
                */
                // initialEvents: t,
                // eventDidMount: function(info) {
                //     $(info.el).find(".fc-event-title").prepend("<b style='display: block'>"+getRemainingDays(info.event.dateTo)+"</b>");
                // },
                events: (info, success, fail) => {
                    $.get('/calendar/events', function (data) {
                        let dataToRender = data.events.map(x => {
                            x.start = x.timeFrom ? `${x.dateFrom}T${x.timeFrom}` : x.dateFrom;
                            x.end = x.timeTo ? `${x.dateTo}T${x.timeTo}` : x.dateTo;
                            if (!x.timeFrom) {
                                x.start =  `${x.dateFrom}`
                                x.end =  `${x.dateTo}T23:59:00`;
                            }
                            return x;
                        });
                        success(dataToRender);
                    })
                }

            },

        }

    },

    methods: {
        handleEventRender(info) {
            const event = info.event
console.log(info)
            // Check if the event's title is '12a'
            if (event.timeTo === '23:59:00') {
                event.setProp('displayEventTime', false)
            }
        },
         getRemainingDays(dateTo) {
    const start = new Date();
    const end = moment(dateTo);
    const duration = moment.duration(end.diff(start));

    const days = duration.asDays();

    return Math.ceil(days);

},

        openAddEventModal() {
            this.form.title = '';
            this.form.timeFrom = '';
            this.form.timeTo = '';
            this.form.dateFrom = eventDetails.value[0];
            this.form.dateTo = eventDetails.value[1];

            // Open the add event modal
            $('#con-close-modal').modal('show');
        },
        handleWeekendsToggle() {
            this.calendarOptions.weekends = !this.calendarOptions.weekends // update a property
        },
        handleDateSelect(selectInfo) {
            eventDetails.value.push(selectInfo)
            // eventDetails.value.push(selectInfo.startStr, selectInfo.endStr)

            $('#con-close-modal').modal('show')
        },

        handleEventClick(clickInfo) {
            // if (confirm(`Are you sure you want to delete the event '${clickInfo.event.title}'`)) {
            $('#editEventModal').modal('show')
            eventEditDetails.value.push(clickInfo.event)
            // }
        },
        handleEventResize(info){
            resize.value.push(info)
        },
        handleEvents(events) {
             console.log(events)
            this.currentEvents = events
        },

    }

})

</script>
<template>

    <button @click="openAddEventModal" type="button" class="btn btn-info waves-effect waves-light mt-1" data-bs-toggle="modal" data-bs-target="#con-close-modal">Add Event</button>

    <!--<Modal dialog="true"/>-->
    <!--    <button @click="">OpenModal</button>-->
    <!--        <button type="button" class="btn btn-success waves-effect waves-light mt-1" data-bs-toggle="modal" data-bs-target="#con-close-modal">Responsive Modal</button>-->
    <div id="con-close-modal" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Event</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" @submit.prevent="submit">
                    <div class="modal-body p-4">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="field-1" class="form-label">Title</label>
                                    <input type="text" v-model="form.title" name="title" id="title" class="form-control"
                                           placeholder="appointment">
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="field-4" class="form-label">Date from</label>
                                    <input type="date" name="dateFrom" id="dateFrom" v-model="form.dateFrom"
                                           class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="field-5" class="form-label">Date to</label>
                                    <input type="date" v-model="form.dateTo" name="dateTo" id="dateTo"
                                           class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="field-5" class="form-label">Time From</label>
                                    <input type="time" v-model="form.timeFrom" name="timeFrom" id="timeFrom"
                                           class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="field-5" class="form-label">Time To</label>
                                    <input type="time" v-model="form.timeTo" name="timeTo" id="timeTo"
                                           class="form-control">
                                </div>
                            </div>
                        </div>
                        <!--                    <div class="row">-->
                        <!--                        <div class="col-md-12">-->
                        <!--                            <div class="">-->
                        <!--                                <label for="field-7" class="form-label">Personal Info</label>-->
                        <!--                                <textarea class="form-control" id="field-7" placeholder="Write something about yourself"></textarea>-->
                        <!--                            </div>-->
                        <!--                        </div>-->
                        <!--                    </div>-->
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close
                        </button>
                        <button type="submit" class="btn btn-info waves-effect waves-light" @click="updateCalendar">Add
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
    <!--    Edit Event Modal-->

    <div id="editEventModal" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Event</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" @submit.prevent="update">
                    <div class="modal-body p-4">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="field-1" class="form-label">Title</label>
                                    <input type="text" v-model="editForm.title" name="title" id="title"
                                           class="form-control"
                                           placeholder="appointment">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="field-4" class="form-label">Date from</label>
                                    <input type="date" name="dateFrom" id="dateFrom" v-model="editForm.dateFrom"
                                           class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="field-5" class="form-label">Date to</label>
                                    <input type="date" v-model="editForm.dateTo" name="dateTo" id="dateTo"
                                           class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="field-5" class="form-label">Time from</label>
                                    <input type="time" v-model="editForm.timeFrom" name="timeFrom" id="timeFrom"
                                           class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="field-5" class="form-label">Time to</label>
                                    <input type="time" v-model="editForm.timeTo" name="timeTo" id="timeTo"
                                           class="form-control">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close
                        </button>
                        <button type="button" class="btn btn-danger waves-effect" @click="remove"
                                data-bs-dismiss="modal">Delete
                        </button>
                        <button type="submit" class="btn btn-info waves-effect waves-light">Save
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
    <!--    <div class='demo-app'>-->
    <!--        <div class='demo-app-sidebar'>-->
    <!--            <div class='demo-app-sidebar-section'>-->
    <!--                <h2>Instructions</h2>-->
    <!--                <ul>-->
    <!--                    <li>Select dates and you will be prompted to create a new event</li>-->
    <!--                    <li>Drag, drop, and resize events</li>-->
    <!--                    <li>Click an event to delete it</li>-->
    <!--                </ul>-->
    <!--            </div>-->
    <!--            <div class='demo-app-sidebar-section'>-->
    <!--                <label>-->
    <!--                    <input-->
    <!--                        type='checkbox'-->
    <!--                        :checked='calendarOptions.weekends'-->
    <!--                        @change='handleWeekendsToggle'-->
    <!--                    />-->
    <!--                    toggle weekends-->
    <!--                </label>-->
    <!--            </div>-->
    <!--            <div class='demo-app-sidebar-section'>-->
    <!--                <h2>All Events ({{ currentEvents.length }})</h2>-->
    <!--                <ul>-->
    <!--                    <li v-for='event in currentEvents' :key='event.id'>-->
    <!--                        <b>{{ event.startStr }}</b>-->
    <!--                        <i>{{ event.title }}</i>-->
    <!--                    </li>-->
    <!--                </ul>-->
    <!--            </div>-->
    <!--        </div>-->
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class='demo-app-main'>
                        <FullCalendar id="calendar" ref="calendar" v-on:update-calendar="updateCalendar"  :event-render="handleEventRender" @eventDrop="handleEventDrop"  :options="calendarOptions"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
