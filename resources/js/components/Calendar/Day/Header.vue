<template>
    <th
        v-bind:class="{
            now: false, // TODO: next day
            limited: day.day_type == 1, // DAY_TYPE_LIMITED
            collapsed: collapsed,
        }"
        @click="clickHandler()"
        :title="day.day_type == 1 ? today().format('DD.MM.YYYY')+' (Klicken, um Ansicht umzuschalten)' : ''"
        :data-day="day.id">
        <div class="day-header-collapse-hover">{{ today().format('dddd, DD.') }}</div>
        <div class="card card-effect">
            <div :class="{'card-header': 1, 'day-header-So': today().format('E') == 7}">
                {{ today().format('dddd') }}
            </div>
            <div class="card-body">
                {{ today().format('D') }}
            </div>
            <div class="liturgy">
                <div class="liturgy-sermon" v-if="day.liturgy.perikope">
                    <div :class="day.liturgy.litColor" class="liturgy-color" :title="day.liturgy.feastCircleName"></div>
                    <a :href="day.liturgy.currentPerikopeLink" target="_blank">
                        {{ day.liturgy.currentPerikope }}
                    </a>
                </div>
            </div>
            <div class="card-footer day-name" :title="day.liturgy.litProfileGist" v-if="day.liturgy.title">
                {{day.liturgy.title}}
            </div>
        </div>
        <div v-if="hasPermission('urlaub-lesen')">
        <div class="vacation mr-1" v-for="absence in absences" :absence="absence"
             :title="absence.user.name+': '+absence.reason+' ('+absence.durationText+') '+replacementText(absence)">
            <span class="fa fa-globe-europe"></span> {{ absence.user.last_name }}</div>
        </div>
    </th>
</template>

<script>
import moment from "moment";
import EventBus from "../../../plugins/EventBus";
import { CalendarToggleDayColumnEvent} from "../../../events/CalendarToggleDayColumnEvent";

export default {
    props: ['day', 'index', 'absences'],
    data: function() {
        return {
            collapsed: this.hasMine ? false : (this.day.day_type == 1),
            limited: this.day.day_type == 1,
        }
    },
    mounted() {
        EventBus.listen(CalendarToggleDayColumnEvent, this.toggleHandler);
    },
    methods: {
        moment: function (d) {
            return moment(d).locale('de-DE');
        },
        today: function () {
            return moment(this.day.date).locale('de-DE');
        },
        clickHandler: function() {
            if (this.limited) EventBus.publish(new CalendarToggleDayColumnEvent(this.day, !this.collapsed));
        },
        toggleHandler: function(e) {
            if ((null === e.day) || (e.day.id == this.day.id)) this.collapsed = e.state;
        },
        replacementText: function (absence) {
            return absence.replacementText ? '[V: '+absence.replacementText+']' : '';
        },
    },
    computed: {
    }
}
</script>

<style scoped>
    .liturgy-color.white {
        background-color: white;
        border-color: darkgray;
    }
    .liturgy-color.black {
        background-color:black;
    }
    .liturgy-color.green {
        background-color: darkgreen;
    }
    .liturgy-color.purple {
        background-color: rebeccapurple;
    }

</style>
