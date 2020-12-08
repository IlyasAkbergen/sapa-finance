<template>
    <div class="panel panel-default">
        <div class="panel-heading" role="tab">
            <a :class="`panel-title accordion-toggle collapsed panel-${hasChild ? 'agent' : 'client'}`"
               role="button" data-toggle="collapse"
               @click="expand = !expand"
               href="#" aria-expanded="true">
                <div class="panel-heading-flex">
                    <p class="panel-heading-flex__name">
                        {{ referral.name }}
                    </p>
                    <p class="panel-heading-flex__post">
                        {{ referral.referral_level != null ? referral.referral_level.title : null }}
                    </p>
                    <p class="panel-heading-flex__digit">
                        +10 {{ isDirect ? 'E' : 'KE' }}
                        <img v-show="hasChild && expand"
                             src="../../img/expanded-arrow.svg"
                             class="ml-1">
                        <img v-show="hasChild && !expand"
                             class="ml-1"
                             src="../../img/dropdown-arrow.png">
                    </p>
                </div>
            </a>
        </div>

        <transition
                enter-active-class="transition ease-out duration-200"
                enter-class="transform opacity-0 scale-95"
                enter-to-class="transform opacity-100 scale-100"
                leave-active-class="transition ease-in duration-75"
                leave-class="transform opacity-100 scale-100"
                leave-to-class="transform opacity-0 scale-95">
            <div v-show="expand"
                 class="panel-collapse"
                 role="tabpanel"
            >
                <div class="panel-body">
                    <ReferralItem
                        v-for="referral in referral.all_referrals"
                        :key="referral.id"
                        :referral="referral" />
                </div>
            </div>
        </transition>
    </div>
</template>

<script>
import HasUser from "@/Mixins/HasUser";

export default {
    name: "ReferralItem",
    props: {
      referral: Object
    },
    mixins: [HasUser],
    data() {
        return {
            expand: false
        }
    },
    components: {
      JetDropdown: () => import('../Jetstream/Dropdown')
    },
    computed: {
        hasChild() {
            return this.referral.all_referrals != null && this.referral.all_referrals.length > 0
        },
        isDirect() {
            return this.referral.referrer_id == this.getUser().id
        }
    }
}
</script>
