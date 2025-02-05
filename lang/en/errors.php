<?php
return [
    'Project.Active.Deny' => 'You can not do this action to an active project!',
    'Project.Not.Active' => 'You can not do this action to a non-active project!',
    'Project.User.Delete.Owner' => 'You can not remove the project owner!',
    'Sow.Locked' => 'You can not update a locked SOW!',
    'Align.Not.Alignable' => 'The model is not alignable!',
    'Sow.UnInvitedRole' => 'You have to invite the following roles before aligning the Sow: :roles',
    'Sow.Align.ProjectStatus' => 'You can not align a Sow for an active or finished project',
    'Contract.Align.ProjectStatus' => 'You can not align a contract for an pending or active project',
    'Contract.Align.NotSigned' => 'All contract parties should`ve sign the contract before aligning!',
    'Contract.Align.Pending' => 'Contract is not ready to be aligned!',
    'Sow.Align.MissingMilestoneData' => 'You have to fill all the milestone data before aligning the Sow',
    'Invoice.Align.Paid' => 'The target invoice is already paid!',
    'Contract.Pending' => 'Contract is not ready to be signed!',
    'Contract.Signed' => 'You have already signed this contract!',
    'Contract.NotSigned' => 'You did not signed this contract yet!',
    'Milestone.Completed' => 'The target milestone is already completed!',
    'Milestone.Pending.Works' => 'ALL milestones`s works should`ve done before finalizing the milestone',
    'Invoice' => ['HasTarget' => 'This action can not be applied to the automatically generated Invoices.'],
    'Align' => [
        'Objectives' => [
            'MilestoneDetails' => 'Add all milestones information',
            'ProjectRoles' => 'Invite all project contributors',
            'PartiesSigned' => 'All parties should sign the contract',
            'WorksDone' => 'All works should be done',
            'InvoicePaid' => 'All invoices should get paid',
            'SowStartDate' => 'Please set a start date for the Feature Request',
        ]
    ]
];
