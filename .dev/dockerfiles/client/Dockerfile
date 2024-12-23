ARG NODE_VERSION
FROM node:$NODE_VERSION

# Set the working directory inside the container
WORKDIR /app

COPY client .

# Expose the port your app runs on
EXPOSE 3000

# Define the command to run your app
CMD npm install -y --legacy-peer-deps && npm start