<template>
    <div class="panel panel-default">
        <div class="panel-heading" role="tab" :id="`heading${referral.id}`">
            <a class="panel-title accordion-toggle collapsed panel-agent"
               role="button" data-toggle="collapse"
               href="#collapse6" aria-expanded="false" aria-controls="collapseThree">
                <div class="panel-heading-flex">
                    <p class="panel-heading-flex__name">
                        {{ referral.name }}
                    </p>
                    <p class="panel-heading-flex__post">
                        {{ referral.referral_level != null ? referral.referral_level.title : null }}
                    </p>
                    <p class="panel-heading-flex__digit">
                        +10 Е
                        <svg class="" width="12" height="8" viewBox="0 0 12 8" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M11.5893 7.08942C11.2639 7.41486 10.7362 7.41486 10.4108 7.08942L6.00004 2.67867L1.5893 7.08942C1.26386 7.41486 0.73622 7.41486 0.410784 7.08942C0.0853462 6.76398 0.0853461 6.23634 0.410784 5.91091L5.41078 0.910907C5.73622 0.58547 6.26386 0.58547 6.58929 0.910907L11.5893 5.91091C11.9147 6.23634 11.9147 6.76398 11.5893 7.08942Z" fill="white"></path>
                        </svg>
                    </p>
                </div>
            </a>
        </div>
        <div :id="`collapse${referral.id}`"
             class="panel-collapse collapse" role="tabpanel"
             :aria-labelledby="`heading${referral.id}`">
            <div class="panel-body">
                <div class="panel-body-item">
                    <div class="panel-body-item-flex">
                        <p class="panel-body-item-flex__name">Жасулан</p>
                        <p class="panel-body-item-flex__post">Клиент</p>
                        <p class="panel-body-item-flex__digit">+10 Е</p>
                    </div>
                </div>
                <div class="panel-body-item">
                    <div class="panel-body-item-flex">
                        <p class="panel-body-item-flex__name">Жасулан</p>
                        <p class="panel-body-item-flex__post">Клиент</p>
                        <p class="panel-body-item-flex__digit">+10 Е</p>
                    </div>
                </div>
                <div class="panel-body-item">
                    <div class="panel-body-item-flex">
                        <p class="panel-body-item-flex__name">Жасулан</p>
                        <p class="panel-body-item-flex__post">Клиент</p>
                        <p class="panel-body-item-flex__digit">+10 Е</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "ReferralItem",
    props: {
      referral: Object
    }
}
</script>
