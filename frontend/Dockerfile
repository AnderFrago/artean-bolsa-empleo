FROM node:14.15.5 AS build
WORKDIR /usr/src/app
COPY package.json ./
RUN npm install
RUN npm install -g @angular/cli@11.2.1
COPY . .
RUN npm run build

CMD ng serve --port 4200 --host 0.0.0.0



EXPOSE 4200

