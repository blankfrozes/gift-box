import axios from 'axios';

export const getVoucherReward = async (code) => {

  try {
    const {data: voucher} = await axios.post(`/api/v1/voucher/use`, { voucher_code: code });

    return voucher;
  } catch (error) {
    throw error;
  }
};

export const useVoucher = async (id) => {

  try {
    await axios.post(`/api/v1/voucher/use/${id}`);

    return;
  } catch (error) {
    throw error;
  }
};
