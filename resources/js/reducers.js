// reducer.js
const initialState = {
    // state lainnya...
    cartItems: [],
};

// reducer function
const rootReducer = (state = initialState, action) => {
    switch (action.type) {
        case "ADD_TO_CART":
            return {
                ...state,
                cartItems: [...state.cartItems, action.payload],
            };
        // cases lainnya...
        default:
            return state;
    }
};

export default rootReducer;
