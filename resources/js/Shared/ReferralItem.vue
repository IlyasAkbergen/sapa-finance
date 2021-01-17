<template>
  <div :class="`panel panel-default ${isDraggedOver ? 'isDraggedOver' : ''}`"
       :draggable="isAdmin"
       @dragstart="dragStart"
       @dragend="dragEnd"
       :id="referral.id"
       @dragenter="isDraggedOver = true"
       @dragleave="isDraggedOver = false"
  >
    <div class="panel-heading border-bottom-1" role="tab"
         :id="referral.id"
         @drop.stop="(e) => drop(e)"
         @dragover.stop
         @dragenter.prevent
         @dragover.prevent
    >
      <a :class="`panel-title accordion-toggle collapsed
                  panel-${hasChild ? 'agent' : 'client'}
                  ${isDraggedOver ? 'isDraggedOver' : ''}
                `"
         :id="referral.id"
         role="button" data-toggle="collapse"
         @click="expand = !expand"
         href="#" aria-expanded="true"
      >
        <div class="panel-heading-flex">
          <p class="panel-heading-flex__name">
            {{ referral.id + " " + referral.name + " <" + referral.email + ", " + referral.phone + ">"}}
          </p>
          <p class="panel-heading-flex__post">
            {{ referral.referral_level != null ? referral.referral_level.title : null }}
          </p>
          <p class="panel-heading-flex__digit">
            <!--                        +10 {{ isDirect ? 'E' : 'KE' }}-->
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
           class="panel-collapse ml-2 pl-4"
           role="tabpanel"
      >
        <div class="panel-body">
          <ReferralItem
            v-for="referral in referral.all_referrals"
            :key="referral.id"
            @change="(data) => $emit('change', data)"
            :referral="referral"/>
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
      referral: Object,
    },
    mixins: [HasUser],
    data() {
      return {
        expand: false,
        isDraggedOver: false
      }
    },
    components: {
      JetDropdown: () => import('../Jetstream/Dropdown'),
    },
    computed: {
      hasChild() {
        return this.referral.all_referrals != null && this.referral.all_referrals.length > 0
      },
      isDirect() {
        return this.referral.referrer_id == this.getUser().id
      }
    },
    methods: {
      drop(e) {
        const child_id = e.dataTransfer.getData('child_id');
        const parent_id = this.referral.id;

        if (child_id !== parent_id) {
          this.$emit('change', {
            parent_id,
            child_id
          })
          this.isDraggedOver = false
        }
      },
      dragStart: e => {
        const target = e.target;
        e.dataTransfer.setData('child_id', target.id);
      },
      dragEnd: e => {
        const target = e.target;
        e.dataTransfer.setData('child_id', target.id);
      },
    }
  }
</script>

<style scoped>
  .panel-collapse {
    z-index: 1;
  }
  a.panel-title {
    z-index: 9999;
  }
  .border-bottom-1 {
    border-bottom: 1px solid #dee2e6;
  }
  .isDraggedOver {
    border: 3px dotted #dee2e6;
  }
  .isDraggedOver a.panel-title {
    background-color: rgba(2, 2, 2, 0.15) !important;
  }
</style>
