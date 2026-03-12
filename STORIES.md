# Campaign Model User Stories

## Scope
These stories describe the current business and functional logic implemented around `App\Models\MBO\Campaign` and tightly coupled flows (`UserCampaign`, campaign forms/controllers, policies, listeners, and objective assignment behavior).

## Domain Summary
- A Campaign has:
  - Hard lifecycle stages: `pending`, `in_progress`, `completed`, `terminated`, `canceled`.
  - Soft timeline stages: `definition`, `disposition`, `realization`, `evaluation`, `self_evaluation`.
  - Visibility flags: `draft` and `manual`.
- Campaign users are managed via `UserCampaign` records.
- Campaign objectives are managed via `Objective` records and assigned per user via `UserObjective`.

## Story 1: Create Campaign With Ordered Timeline
**As an MBO administrator**, I want to create a campaign with a valid stage timeline so that the process has a controlled and chronological lifecycle.

### Acceptance Criteria
- Campaign create form requires:
  - `name` (max 120), `period` (max 10).
  - If manual mode is off: all stage date ranges are required and date-valid.
- Stage date order must be chronological:
  - `definition_from <= definition_to`
  - `disposition_from > definition_from`
  - `realization_from > disposition_from`
  - `evaluation_from > realization_from`
  - `self_evaluation_from > evaluation_from`
- Campaign defaults:
  - `stage = pending`
  - `draft = true` (when not explicitly changed)
  - `manual = false` (when not explicitly changed)

## Story 2: Manual Mode Is Globally Governed
**As a system administrator**, I want a global setting to disable campaign manual mode so that campaigns cannot remain in manual flow when policy disallows it.

### Acceptance Criteria
- On campaign create/update, `checkManual()` forces `manual = 0` when `settings('mbo.campaigns_manual')` is false.
- Even if request payload attempts to set manual true, persisted value is false when the setting is disabled.

## Story 3: Assign and Maintain Campaign Coordinators
**As an MBO administrator**, I want to assign coordinators to a campaign so that campaign-level delegated management is explicit and context-scoped.

### Acceptance Criteria
- On create/update, coordinator IDs from form (`user_ids`) are synchronized.
- Removed coordinators lose role `campaign-coordinator` in this campaign context.
- Added coordinators receive role `campaign-coordinator` in this campaign context.
- Coordinator assignment is context-bound to specific campaign ID.

## Story 4: Campaign List Visibility Is Permission and Context Scoped
**As a user**, I want to see only campaigns I am authorized for so that unauthorized data is never exposed.

### Acceptance Criteria
- Global query scope orders campaigns by `definition_from`.
- If user has MBO administration permission: all campaigns are visible.
- If user has campaign view permission but is not MBO admin: only campaigns where user has campaign-coordinator role context are visible.
- If user has no campaign view permission: query returns no campaigns.

## Story 5: View Campaign Details Based on Policy
**As a campaign participant or coordinator**, I want to open campaign details only when I have access so that campaign data remains controlled.

### Acceptance Criteria
- `CampaignPolicy@viewAny` requires campaign-view permission.
- `CampaignPolicy@view` requires campaign-view permission in campaign context.
- Tests confirm:
  - Assigned users can view campaign.
  - Non-assigned users cannot view campaign.
  - Coordinator with matching campaign context can view campaign.

## Story 6: Edit Campaign by Authorized Users Only
**As a coordinator with correct context**, I want to edit campaign settings so that delegated campaign owners can maintain campaign details.

### Acceptance Criteria
- `CampaignPolicy@update` controls edit/update authorization.
- Coordinator can edit only campaigns matching their role context.
- Coordinator with different campaign context cannot open edit page.
- Update uses same validation/business constraints as create flow.

## Story 7: Automatic Campaign Stage Resolution by Dates
**As the system**, I want campaign hard stage to be auto-derived from configured date windows so that lifecycle transitions happen without manual intervention.

### Acceptance Criteria
- On campaign update event, listener calls `setStageAuto()` and persists quietly.
- `setStageAuto()` behavior:
  - If campaign stage is `terminated` or `canceled`, do not auto-change.
  - Else set stage to `in_progress` when current time is inside any soft-stage date range.
  - Else keep stage `pending`.
  - If campaign end (`self_evaluation_to`) is past, force stage `completed`.

## Story 8: Derive Current Effective Stage(s)
**As a campaign consumer (UI/reporting)**, I want current stage data that reflects both hard and soft lifecycle so the displayed state is meaningful.

### Acceptance Criteria
- If campaign hard stage is `in_progress`, current stage list includes active soft stage(s) based on date windows.
- If no soft stage window currently matches while hard stage is `in_progress`, current stage list contains `in_progress`.
- If hard stage is not `in_progress`, current stage list contains that hard stage only.
- `isStageActive(stage)` checks membership in derived current stages.

## Story 9: Determine Operational Campaign State
**As business logic**, I want clear campaign state checks so that policies/UI can gate operations reliably.

### Acceptance Criteria
- `isActive()` is true only when campaign is not draft, not terminated, not canceled, and not completed.
- `open()` is true when now is between campaign start (`definition_from`) and end (`self_evaluation_to`) and campaign is not draft.
- `finished()` for non-manual campaigns is true only when now is after end date.
- `inDates()` returns true only when now is between start and end and both dates exist.

## Story 10: Terminate Campaign and Propagate to All Assigned Users
**As an authorized manager**, I want to suspend an active campaign so that user-level campaign work is stopped consistently.

### Acceptance Criteria
- Campaign terminate allowed by policy only when campaign is active or already terminated and caller has terminate permission.
- `campaign->terminate()`:
  - sets campaign stage to `terminated` if not already.
  - iterates all `user_campaigns` and calls `terminate()` on each.
- Users in terminated campaign are no longer in active/ongoing flows.

## Story 11: Cancel Campaign and Propagate Final Inactive State
**As an authorized manager**, I want to cancel a campaign irreversibly so that all operational activity stops.

### Acceptance Criteria
- Cancel allowed only for active campaigns with cancel permission.
- `campaign->cancel()` sets campaign stage to `canceled` and cancels all `user_campaigns`.
- Canceled campaigns are excluded from active flows and treated as archival from business perspective.

## Story 12: Resume Campaign From Terminated State
**As an authorized manager**, I want to resume a terminated campaign so that campaign execution can continue.

### Acceptance Criteria
- `campaign->resume()` works only when campaign stage is `terminated`.
- Resume sets campaign stage to `in_progress` and resumes all `user_campaigns` to `in_progress`.

## Story 13: Enroll a User Into Campaign
**As a campaign coordinator/admin**, I want to assign users to a campaign so they can receive campaign objectives and stage tracking.

### Acceptance Criteria
- Assign creates `UserCampaign` only if no existing assignment for `(campaign_id, user_id)`.
- New assignment values:
  - `stage` = current campaign-derived user stage (`setUserStage`)
  - `manual` = campaign manual flag
  - `active` = `0` if campaign is draft, otherwise `1`
- On `UserCampaign` creation event, all campaign objectives are auto-assigned to that user (`UserObjective::assign`).

## Story 14: Bulk Sync Campaign Enrollments
**As a coordinator/admin**, I want to submit the full participant list in one action so assignment state is synchronized efficiently.

### Acceptance Criteria
- Bulk assignment service compares submitted `user_ids` with current assigned users.
- Users present in payload but absent in DB are assigned.
- Users currently assigned but absent from payload are unassigned.
- Coordinators are excluded from selectable candidates in add-users form.

## Story 15: Unenroll User From Campaign
**As a coordinator/admin**, I want to remove a participant from campaign so they stop being tracked in campaign user roster.

### Acceptance Criteria
- Unassign deletes corresponding `UserCampaign` record.
- User unassignment emits domain event (`UserCampaignUnassigned`) for downstream notifications.

## Story 16: Keep UserCampaign Stages Aligned Automatically
**As the system**, I want non-manual user campaign stages to auto-align with campaign stage so user progression follows campaign lifecycle.

### Acceptance Criteria
- When campaign is updated, listener runs `campaign->setUserStage()`.
- Stage sync only affects `UserCampaign` records where:
  - `manual = 0`
  - `active = 1`
  - matching `campaign_id`
- Optional specific user sync path exists (`setUserStage($userId)`).
- If no current active stage is derivable, fallback stage is `pending`.

## Story 17: Support Per-User Manual Stage Control
**As a coordinator/admin**, I want to place a participant in manual stage mode so I can override automatic timeline progression.

### Acceptance Criteria
- Toggling manual on user assignment flips `UserCampaign.manual`.
- When manual is toggled, stage is reset via campaign-derived stage calculation.
- User is considered manual if either `UserCampaign.manual` or `Campaign.manual` is true.
- In manual mode, stage can be moved forward/backward through stage sequence boundaries.

## Story 18: Restrict Objective and User Management by Campaign Stage
**As a campaign manager**, I want management actions enabled only in valid lifecycle stages so campaign governance is enforced.

### Acceptance Criteria
- Managing objectives requires:
  - campaign active
  - permission `mbo-campaign-manage-objectives`
  - current stage includes `definition` OR `settings('mbo.campaigns_ignore_dates')` is true.
- Managing users requires:
  - campaign active
  - permission `mbo-campaign-manage-users`
  - current stage includes `definition` or `disposition` OR ignore-dates setting is true.
- Manual management requires campaign active + `mbo-campaign-manage-manual`.

## Story 19: Add Campaign Objective and Auto-Assign to Existing Participants
**As a coordinator/admin**, I want newly created campaign objectives to be automatically distributed to current participants.

### Acceptance Criteria
- Objective creation for campaign supports template-based uniqueness in UI (already-used templates excluded except currently edited one).
- Objective deadline is constrained to campaign realization window in form.
- If objective is created without deadline and has campaign, default deadline becomes campaign `realization_to`.
- After objective creation, each existing `UserCampaign` user receives corresponding `UserObjective` assignment.

## Story 20: Map UserObjective Status From Campaign/UserCampaign Stage
**As the system**, I want objective statuses to reflect campaign stage so users see correct execution status.

### Acceptance Criteria
- `CampaignStage::mapObjectiveStatus()` mapping rules:
  - `realization` or `in_progress` -> objective `progress`
  - stages before realization -> objective `unstarted`
  - stages after realization -> objective `completed`
  - evaluated/frozen objective statuses are not overwritten.
- If user campaign is inactive, objective status becomes `interrupted`.
- On assignment and relevant updates, objective status recalculation is executed (`setStatus()`).

## Story 21: Campaign Progress and Presentation Data
**As a user**, I want campaign cards/summary to expose useful progress and status indicators for quick situational awareness.

### Acceptance Criteria
- Progress percentage is derived from elapsed days between campaign start and end.
- Card shows badges/icons for draft, in-progress, manual, terminated, canceled.
- Card shows participants count and objectives count.
- Summary presents soft-stage date ranges with current stage highlighted.

## Story 22: Search/Route Integration
**As an end user**, I want campaign links to consistently resolve to detail views so navigation works across search and UI components.

### Acceptance Criteria
- Campaign implements `routeShow()` returning `route('campaigns.show', campaign_id)`.
- Campaign is searchable via attached search traits/resources in application architecture.

## Functional Invariants (Cross-Cutting)
- Campaign lifecycle hard states are mutually exclusive at persistence level.
- Soft stages are time windows, not persisted as hard stage values.
- Draft campaigns are non-active and hidden from normal operational flows.
- Terminated/canceled/completed campaigns are non-active.
- User assignment and objective assignment are eventually consistent through model events/listeners.

## Known Behavioral Notes
- `CampaignPolicy@resume` currently checks `canceled()` while `Campaign::resume()` only resumes from `terminated`; this is an implementation inconsistency to track.
- `CampaignUserController` mutating endpoints (toggle manual / move stage) do not explicitly call policy authorization in controller methods; access may rely on route/module context and UI gating.
