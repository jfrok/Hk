<template>
    <div>
        <a-steps v-model:current="current" type="navigation" size="small" :style="stepStyle">
            <a-step
                title="Step 1"
                status="process"
                description="This is a description."
            />

            <a-step
                title="Step 2"
                status="process"
                description="This is a description."
            />
            <a-step
                title="Step 3"
                status="process"
                description="Rest api token."
            />
        </a-steps>
        <div class="steps-content">
            <div class="card">
                <div class="card-body">
                    <div v-if="steps[current].title == 1">
                        <div class="container">
                            <div class="row">
                                <v-switch v-model="eventSettings.sendReminders" inset color="primary" label="Send remainders" />
<!--                                <InputError class="mt-2" :message="eventSettings.errors.sendReminders" />-->
                                <v-row v-if="eventSettings.sendReminders">
                                    <v-col cols="12">
                                        <v-text-field type="number" v-model="eventSettings.sendBefore" label="Before the event"></v-text-field>
                                        <InputError class="mt-2" :message="eventSettings.errors.sendBefore" />
                                    </v-col>
<!--                                    <v-col cols="12">-->
<!--                                        <v-text-field type="time" v-model="eventSettings.sendTime" label="Send time"></v-text-field>-->
<!--                                        <InputError class="mt-2" :message="eventSettings.errors.sendTime" />-->
<!--                                    </v-col>-->

                                </v-row>

                            </div>
                        </div>
                        <v-sheet style="float: right;padding: 20px 30px">
                            <v-btn type="button" @click="updateEvents" block class="mt-2">Apply</v-btn>
                        </v-sheet>
                    </div>
                    <div v-if="steps[current].title == 2">
                        step 2

                    </div>
                    <div v-if="steps[current].title == 3">

                        <!--                        <template>-->
                        <v-sheet width="300" class="mx-auto">
                            <v-text-field
                                label="Rest token"
                                :append-icon="'mdi-refresh'"
                                @click:append="generateToken"
                                v-model="restApiToken.token"
                                id="token"
                            ></v-text-field>
                        </v-sheet>
                        <v-sheet>
                            <h6>last update at {{ moment(settings.updated_at).format('DD/MM/YYYY') }}</h6>
                        </v-sheet>
                        <!--
                                             </template>-->
                        <v-sheet v-for="apiRoute in apiRoutes" class="mt-5">
                            <v-sheet v-if="apiRoute.uri != 'api/user'">

                                <v-card

                                    max-width="300"
                                >
                                    <v-list

                                    >
                                        <v-list-item-title>
                                            {{ apiRoute.uri }}
                                        </v-list-item-title>
                                    </v-list>
                                </v-card>
                            </v-sheet>
                        </v-sheet>

                        <v-sheet style="float: right;padding: 20px 30px">
                            <v-btn type="button" @click="updateToken" block class="mt-2">Apply</v-btn>
                        </v-sheet>
                    </div>
                </div>
            </div>
        </div>
        <!--        <div class="steps-action">-->
        <!--            <a-button v-if="current < steps.length - 1" type="primary" @click="next">Next</a-button>-->
        <!--            <a-button-->
        <!--                v-if="current == steps.length - 1"-->
        <!--                type="primary"-->

        <!--            >-->

        <!--                Done-->
        <!--            </a-button>-->
        <!--            <a-button v-if="current > 0" style="margin-left: 8px" @click="prev">Previous</a-button>-->
        <!--        </div>-->
    </div>
</template>
<script lang="ts">
import {defineComponent, reactive, ref, watch} from 'vue';
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {useForm} from "@inertiajs/vue3";

import format from "@popperjs/core/lib/utils/format";
import moment from "moment";
import InputError from "@/Components/InputError.vue";

export default defineComponent({
    layout: AuthenticatedLayout,
    components: {InputError},
    props: {
        settings: Array,
        apiRoutes: Array,

    },
    setup(props) {
        const current = ref<number>(0);


        // function copyPassword() {
        //     let copyText = document.getElementById("password");
        //     copyText.select();
        //     document.execCommand("copy");
        // }
        const next = () => {
            current.value++;
        };
        const prev = () => {
            current.value--;
        };
        let restApiToken = useForm({
            token: props.settings.api_token
        })
        let updateToken = async () => {
            await restApiToken.post(route('settings.updateToken'), {})
        }
        let eventSettings = useForm({
            sendReminders:props.settings.sendRemainders = 1 ? true : false,
            sendBefore:props.settings.sendBefore,
            sendTime:props.settings.sendAt,
        })
     // watch( () => eventSettings, ($eventSettings) =>{
     //     console.log($eventSettings + ' ff')
     //    })

            let updateEvents = async () => {
            await eventSettings.post(route('settings.eventSettings'),{
                preserveState: true,
                preserveScroll: true,
            })
        }
        return {
            current,
            steps: [
                {
                    title: '1',
                },
                {
                    title: '2',
                },
                {
                    title: '3',
                },
            ],
            restApiToken,
            eventSettings,
            updateToken,
            updateEvents,
            next,
            prev,
        };
    },

    methods: {
        format,
        moment,
        generateToken() {
            let result = "";
            let characters =
                "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789@$";
            let charactersLength = characters.length;
            for (let i = 0; i < 20; i++) {
                result += characters.charAt(Math.floor(Math.random() * charactersLength));
            }
            this.restApiToken.token = result;
        }

    }
});
</script>
<!--<style scoped>-->
<!--.steps-content {-->
<!--    margin-top: 16px;-->
<!--    border: 1px dashed #e9e9e9;-->
<!--    border-radius: 6px;-->
<!--    background-color: #fafafa;-->
<!--    min-height: 200px;-->
<!--    text-align: center;-->
<!--    padding-top: 80px;-->
<!--}-->

<!--.steps-action {-->
<!--    margin-top: 24px;-->
<!--}-->

<!--[data-theme='dark'] .steps-content {-->
<!--    background-color: #2f2f2f;-->
<!--    border: 1px dashed #404040;-->
<!--}-->
<!--</style>-->
