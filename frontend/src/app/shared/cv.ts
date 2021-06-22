export interface Cv {
    id: number
    works: Array<WorkExperiences>,
    studies: Array<Studies>,
    languages: Array<Language>,
    otherknowledges?: Array<OtherKnowledge>
}
export interface WorkExperiences {
    position: string,
    employer: string,
    location: string,
    duties: string,
    startDate: Date,
    endDate: Date,
}
export interface Studies {
    title: string,
    description: string
    category: string,
    level: string,
    center: string,
    startDate: Date,
    endDate: Date,
}
export interface Language {
    name: string,
    title?: string,
}
export interface OtherKnowledge {
    name: string,
    description: string
    title?: string,
}