export interface Offer {
    id: number,
    company: string,
    dueDate: Date,
    position: String,
    requirements?: Requirements,
    description: Description,
    numberOfApplyments: number,
    owner?,
    originalFileName: string,

}
export interface Description {
    text: string,
}
export interface Requirements {
    minimumRequirements: string
}

export enum OfferState {
    NoApplied = 0,
    Applied = 1,
    WaitingResponse = 2,
    Discard = 3,
    Selected = 4
}


