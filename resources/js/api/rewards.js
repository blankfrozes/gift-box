import axios from 'axios';

export const getAllRewards = async () => {
  return axios.get(`/api/v1/rewards`).then(t => t.data);
};
